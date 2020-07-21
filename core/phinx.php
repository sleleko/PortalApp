<?php

use Symfony\Component\Dotenv\Dotenv;
use Vesp\Services\Eloquent;

require dirname(__FILE__) . '/vendor/autoload.php';

try {
    $dotenv = new Dotenv(true);
    $dotenv->loadEnv(dirname(__DIR__) . '/core/.env');
} catch (Throwable $e) {
    exit($e->getMessage());
}

$eloquent = new Eloquent();
$config = $eloquent->getConnection()->getConfig();

return [
    'paths' => [
        'migrations' => dirname(__FILE__) . '/db/migrations',
        'seeds' => dirname(__FILE__) . '/db/seeds',
    ],
    'migration_base_class' => 'Vesp\Services\Migration',
    'environments' => [
        'default_migration_table' => $config['prefix'] . 'migrations',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => $config['driver'],
            'host' => $config['host'],
            'name' => $config['database'],
            'user' => $config['username'],
            'pass' => $config['password'],
            'port' => $config['port'],
            'charset' => $config['charset'],
            'collation' => $config['collation'],
            'table_prefix' => $config['prefix'],
        ],
    ],
];
