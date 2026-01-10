<?php

return [
    'default' => [
        'hosts' => explode(',', env('LDAP_HOSTS', 'ldap://dc1.example.com')),
        'port' => env('LDAP_PORT', 389),
        'base_dn' => env('LDAP_BASE_DN', 'dc=example,dc=com'),
        'username' => env('LDAP_USERNAME'),
        'password' => env('LDAP_PASSWORD'),
        'timeout' => env('LDAP_TIMEOUT', 5),
        'version' => env('LDAP_VERSION', 3),
        'use_tls' => env('LDAP_USE_TLS', false),
        'use_ssl' => env('LDAP_USE_SSL', false),
    ],
];
