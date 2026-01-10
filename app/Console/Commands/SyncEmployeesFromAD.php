<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LdapService;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SyncEmployeesFromAD extends Command
{
    protected $signature = 'ad:sync 
                            {--department= : Sync specific department}
                            {--search= : Search term}
                            {--limit=1000 : Maximum users to sync}';

    protected $description = 'Sync employees from Active Directory to local database';

    protected $ldapService;

    public function __construct(LdapService $ldapService)
    {
        parent::__construct();
        $this->ldapService = $ldapService;
    }

    public function handle()
    {
        $this->info('Starting AD sync...');

        try {
            // Test connection
            $test = $this->ldapService->testConnection();
            if (!$test['success']) {
                $this->error('LDAP connection failed: ' . $test['message']);
                return 1;
            }

            $this->info('✓ LDAP connected successfully');

            // Prepare filters
            $filters = [];
            if ($department = $this->option('department')) {
                $filters['department'] = $department;
                $this->info("Filtering by department: {$department}");
            }

            if ($search = $this->option('search')) {
                $filters['search'] = $search;
                $this->info("Search term: {$search}");
            }

            // Get employees from AD
            $limit = (int) $this->option('limit');
            $employees = $this->ldapService->searchEmployees($filters, $limit);

            $this->info("Found " . count($employees) . " employees in AD");

            $synced = 0;
            $updated = 0;
            $errors = 0;

            foreach ($employees as $employeeData) {
                try {
                    if (empty($employeeData['username'])) {
                        $this->warn("Skipping employee without username");
                        continue;
                    }

                    // Find or create employee
                    $employee = User::updateOrCreate(
                        ['username' => $employeeData['username']],
                        array_merge($employeeData, ['last_sync_at' => now()])
                    );

                    if ($employee->wasRecentlyCreated) {
                        $synced++;
                        $this->line("✓ Created: {$employeeData['display_name']}");
                    } else {
                        $updated++;
                        $this->line("↻ Updated: {$employeeData['display_name']}");
                    }
                } catch (\Exception $e) {
                    $errors++;
                    $this->error("✗ Error: " . $e->getMessage());
                    Log::error('AD Sync Error: ' . $e->getMessage(), [
                        'employee' => $employeeData['username'] ?? 'unknown'
                    ]);
                }
            }

            $this->info("\nSync completed!");
            $this->info("New: {$synced}, Updated: {$updated}, Errors: {$errors}");

            return 0;
        } catch (\Exception $e) {
            $this->error('Sync failed: ' . $e->getMessage());
            Log::error('AD Sync Failed: ' . $e->getMessage());
            return 1;
        }
    }
}
