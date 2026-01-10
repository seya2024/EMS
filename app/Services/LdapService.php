<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class LdapService
{
    protected $connection;
    protected $config;

    public function __construct()
    {
        $this->config = [
            'hosts' => explode(',', env('LDAP_HOSTS', 'ldap://dc1.example.com,ldap://dc2.example.com')),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=example,dc=com'),
            'username' => env('LDAP_USERNAME', 'cn=admin,dc=example,dc=com'),
            'password' => env('LDAP_PASSWORD', ''),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'version' => env('LDAP_VERSION', 3),
            'use_tls' => env('LDAP_USE_TLS', false),
            'use_ssl' => env('LDAP_USE_SSL', false),
        ];
    }

    /**
     * Connect to LDAP server
     */
    protected function connect()
    {
        if ($this->connection) {
            return $this->connection;
        }

        $connected = false;
        $lastError = '';

        // Try each host until one connects
        foreach ($this->config['hosts'] as $host) {
            try {
                $this->connection = ldap_connect($host, $this->config['port']);

                if (!$this->connection) {
                    continue;
                }

                // Set LDAP options
                ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, $this->config['version']);
                ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);
                ldap_set_option($this->connection, LDAP_OPT_NETWORK_TIMEOUT, $this->config['timeout']);
                ldap_set_option($this->connection, LDAP_OPT_TIMEOUT, $this->config['timeout']);

                // Start TLS if configured
                if ($this->config['use_tls'] && !$this->config['use_ssl']) {
                    if (!ldap_start_tls($this->connection)) {
                        throw new \Exception('Could not start TLS');
                    }
                }

                // Bind with credentials
                $bind = @ldap_bind(
                    $this->connection,
                    $this->config['username'],
                    $this->config['password']
                );

                if ($bind) {
                    $connected = true;
                    break;
                } else {
                    $lastError = ldap_error($this->connection);
                    ldap_close($this->connection);
                    $this->connection = null;
                }
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
                continue;
            }
        }

        if (!$connected) {
            throw new \Exception('Could not connect to any LDAP server. Last error: ' . $lastError);
        }

        return $this->connection;
    }

    /**
     * Search LDAP directory
     */
    public function search($filter, array $attributes = [], $baseDn = null)
    {
        $connection = $this->connect();
        $baseDn = $baseDn ?: $this->config['base_dn'];

        $search = @ldap_search(
            $connection,
            $baseDn,
            $filter,
            $attributes,
            0, // attributes only
            0, // size limit (0 = unlimited)
            10 // time limit
        );

        if (!$search) {
            throw new \Exception('LDAP search failed: ' . ldap_error($connection));
        }

        $entries = ldap_get_entries($connection, $search);
        ldap_free_result($search);

        return $this->normalizeEntries($entries);
    }

    /**
     * Normalize LDAP entries
     */
    protected function normalizeEntries($entries)
    {
        if (!$entries || $entries['count'] == 0) {
            return [];
        }

        $normalized = [];
        for ($i = 0; $i < $entries['count']; $i++) {
            $entry = $entries[$i];
            $normalizedEntry = [];

            foreach ($entry as $key => $value) {
                if (is_int($key) || $key === 'count') {
                    continue;
                }

                if (isset($value['count']) && $value['count'] == 1) {
                    $normalizedEntry[$key] = $value[0];
                } elseif (isset($value['count'])) {
                    $normalizedEntry[$key] = array_slice($value, 0, $value['count']);
                } else {
                    $normalizedEntry[$key] = $value;
                }
            }

            $normalized[] = $normalizedEntry;
        }

        return $normalized;
    }

    /**
     * Search employees in Active Directory
     */
    public function searchEmployees(array $filters = [], int $limit = 100)
    {
        try {
            // Build search filter
            $searchFilter = '(&(objectClass=user)(objectCategory=person)';

            if (!empty($filters['search'])) {
                $searchTerm = $this->escapeLdapSearch($filters['search']);
                $searchFilter .= "(|(cn=*{$searchTerm}*)(samaccountname=*{$searchTerm}*)(mail=*{$searchTerm}*)(displayname=*{$searchTerm}*))";
            }

            if (!empty($filters['department'])) {
                $dept = $this->escapeLdapSearch($filters['department']);
                $searchFilter .= "(department={$dept})";
            }

            if (!empty($filters['title'])) {
                $title = $this->escapeLdapSearch($filters['title']);
                $searchFilter .= "(title={$title})";
            }

            $searchFilter .= '(!(userAccountControl:1.2.840.113556.1.4.803:=2)))'; // Not disabled

            // Attributes to retrieve
            $attributes = [
                'employeeid',
                'samaccountname',
                'mail',
                'givenname',
                'sn',
                'displayname',
                'department',
                'title',
                'manager',
                'physicaldeliveryofficename',
                'telephonenumber',
                'mobile',
                'streetaddress',
                'l',
                'st',
                'postalcode',
                'c',
                'useraccountcontrol',
                'lastlogon',
                'whencreated',
            ];

            $results = $this->search($searchFilter, $attributes);

            // Apply limit
            if ($limit > 0) {
                $results = array_slice($results, 0, $limit);
            }

            return array_map([$this, 'formatEmployeeData'], $results);
        } catch (\Exception $e) {
            Log::error('LDAP Employee Search Error: ' . $e->getMessage());
            throw new \Exception('Failed to search employees: ' . $e->getMessage());
        }
    }

    /**
     * Get employee by username
     */
    public function getEmployeeByUsername($username)
    {
        try {
            $username = $this->escapeLdapSearch($username);
            $filter = "(&(objectClass=user)(objectCategory=person)(samaccountname={$username}))";

            $results = $this->search($filter);

            if (empty($results)) {
                return null;
            }

            return $this->formatEmployeeData($results[0]);
        } catch (\Exception $e) {
            Log::error('LDAP Get Employee Error: ' . $e->getMessage());
            throw new \Exception('Failed to get employee: ' . $e->getMessage());
        }
    }

    /**
     * Get employee by email
     */
    public function getEmployeeByEmail($email)
    {
        try {
            $email = $this->escapeLdapSearch($email);
            $filter = "(&(objectClass=user)(objectCategory=person)(mail={$email}))";

            $results = $this->search($filter);

            if (empty($results)) {
                return null;
            }

            return $this->formatEmployeeData($results[0]);
        } catch (\Exception $e) {
            Log::error('LDAP Get Employee by Email Error: ' . $e->getMessage());
            throw new \Exception('Failed to get employee by email: ' . $e->getMessage());
        }
    }

    /**
     * Format employee data from LDAP entry
     */
    protected function formatEmployeeData($entry)
    {
        return [
            'employee_id' => $entry['employeeid'][0] ?? $entry['employeeid'] ?? null,
            'username' => $entry['samaccountname'][0] ?? $entry['samaccountname'] ?? null,
            'email' => $entry['mail'][0] ?? $entry['mail'] ?? null,
            'first_name' => $entry['givenname'][0] ?? $entry['givenname'] ?? null,
            'last_name' => $entry['sn'][0] ?? $entry['sn'] ?? null,
            'display_name' => $entry['displayname'][0] ?? $entry['displayname'] ?? null,
            'department' => $entry['department'][0] ?? $entry['department'] ?? null,
            'title' => $entry['title'][0] ?? $entry['title'] ?? null,
            'manager' => $this->extractManagerName($entry['manager'][0] ?? $entry['manager'] ?? null),
            'office' => $entry['physicaldeliveryofficename'][0] ?? $entry['physicaldeliveryofficename'] ?? null,
            'phone' => $entry['telephonenumber'][0] ?? $entry['telephonenumber'] ?? null,
            'mobile' => $entry['mobile'][0] ?? $entry['mobile'] ?? null,
            'street_address' => $entry['streetaddress'][0] ?? $entry['streetaddress'] ?? null,
            'city' => $entry['l'][0] ?? $entry['l'] ?? null,
            'state' => $entry['st'][0] ?? $entry['st'] ?? null,
            'postal_code' => $entry['postalcode'][0] ?? $entry['postalcode'] ?? null,
            'country' => $entry['c'][0] ?? $entry['c'] ?? null,
            'is_active' => $this->isAccountActive($entry['useraccountcontrol'][0] ?? $entry['useraccountcontrol'] ?? 0),
            'last_logon' => $this->convertAdTimestamp($entry['lastlogon'][0] ?? $entry['lastlogon'] ?? null),
            'created_at' => $this->convertAdTimestamp($entry['whencreated'][0] ?? $entry['whencreated'] ?? null, true),
        ];
    }

    /**
     * Check if AD account is active
     */
    protected function isAccountActive($userAccountControl)
    {
        // 514 = ACCOUNTDISABLE (0x2)
        return !(($userAccountControl & 2) === 2);
    }

    /**
     * Convert AD timestamp to DateTime
     */
    protected function convertAdTimestamp($adTimestamp, $isGeneralizedTime = false)
    {
        if (!$adTimestamp) {
            return null;
        }

        try {
            if ($isGeneralizedTime) {
                // Generalized time format: 20240101000000.0Z
                return \DateTime::createFromFormat('YmdHis.0Z', $adTimestamp) ?: null;
            } else {
                // AD timestamp: number of 100-nanosecond intervals since Jan 1, 1601
                $seconds = intval($adTimestamp) / 10000000;
                $unixTimestamp = $seconds - 11644473600; // Convert to Unix timestamp
                return $unixTimestamp > 0 ? date('Y-m-d H:i:s', $unixTimestamp) : null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Extract manager name from DN
     */
    protected function extractManagerName($managerDn)
    {
        if (!$managerDn) {
            return null;
        }

        try {
            preg_match('/CN=([^,]+)/', $managerDn, $matches);
            return $matches[1] ?? $managerDn;
        } catch (\Exception $e) {
            return $managerDn;
        }
    }

    /**
     * Escape LDAP search strings
     */
    protected function escapeLdapSearch($string)
    {
        $metaChars = ['\\', '*', '(', ')', "\0"];
        $escaped = $string;

        foreach ($metaChars as $char) {
            $escaped = str_replace($char, '\\' . str_pad(dechex(ord($char)), 2, '0'), $escaped);
        }

        return $escaped;
    }

    /**
     * Get all departments
     */
    public function getDepartments()
    {
        try {
            $filter = "(&(objectClass=user)(objectCategory=person)(department=*))";
            $attributes = ['department'];

            $results = $this->search($filter, $attributes);

            $departments = [];
            foreach ($results as $result) {
                $dept = $result['department'][0] ?? $result['department'] ?? null;
                if ($dept && !in_array($dept, $departments)) {
                    $departments[] = $dept;
                }
            }

            sort($departments);
            return $departments;
        } catch (\Exception $e) {
            Log::error('LDAP Get Departments Error: ' . $e->getMessage());
            throw new \Exception('Failed to get departments: ' . $e->getMessage());
        }
    }

    /**
     * Test LDAP connection
     */
    public function testConnection()
    {
        try {
            $connection = $this->connect();

            if ($connection) {
                // Try a simple search to verify
                $testSearch = @ldap_search($connection, $this->config['base_dn'], '(objectClass=*)', ['objectClass'], 0, 1);

                if ($testSearch) {
                    ldap_free_result($testSearch);
                    return [
                        'success' => true,
                        'message' => 'LDAP connection successful',
                        'base_dn' => $this->config['base_dn'],
                        'hosts' => $this->config['hosts'],
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'LDAP connection test failed',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'LDAP connection failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Close connection
     */
    public function __destruct()
    {
        if ($this->connection) {
            @ldap_close($this->connection);
            $this->connection = null;
        }
    }
}
