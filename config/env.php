<?php
/**
 * Environment Configuration
 *
 * In production, these should be set via actual environment variables
 * or a .env file outside the webroot. This file serves as the single
 * source of truth for all configuration values.
 */

return [
    'db' => [
        'host'    => getenv('DB_HOST') ?: 'localhost',
        'port'    => getenv('DB_PORT') ?: '3356',
        'dbname'  => getenv('DB_NAME') ?: 'tryfix',
        'user'    => getenv('DB_USER') ?: 'try',
        'pass'    => getenv('DB_PASS') ?: 'qwerasdf1234',
        'charset' => 'utf8mb4',
    ],
    'session' => [
        'lifetime'  => 1800, // 30 minutes
        'name'      => 'ISERVE_SID',
    ],
    'upload' => [
        'max_size'       => 2 * 1024 * 1024, // 2MB
        'allowed_types'  => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        'profile_pic_dir' => '/img/profile_pic/',
    ],
];
