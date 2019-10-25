<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    // 'db' => [
    //     'driver' => 'Pdo',
    //     'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
    // ],
    'orm'        => [
        'auto_generate_proxy_classes' => false,
        'proxy_dir'                   => 'data/cache/EntityProxy',
        'proxy_namespace'             => 'EntityProxy',
        'underscore_naming_strategy'  => true,
    ],
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOSqlite\Driver::class,
                'params' => [
                    'path'=> __DIR__.'/../../data/zftutorial.db'
                ],
            ],
        ],
    ],
];
