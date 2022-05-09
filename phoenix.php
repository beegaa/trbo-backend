<?php

return [
    'migration_dirs' => [
        'migrations' => __DIR__ . '/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'port' => 3306, // optional
            'username' => 'root',
            'password' => '',
            'db_name' => 'trbo',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => 'production_host',
            'port' => 3306, // optional
            'username' => 'root',
            'password' => '',
            'db_name' => 'trbo',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];