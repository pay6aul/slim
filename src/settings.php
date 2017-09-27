<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'mysql' => [
            // Eloquent configuration
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'port'      => '3306',
            'database'  => 'mrbima_db',
            'username'  => 'root',
            'password'  => '0714ki!!',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ],
        'pgsql' => [
            // Eloquent configuration
            'driver' => 'pgsql',
            //  'host' => '41.93.38.76',
            'host' => 'localhost',
            'port' => '5432',
            'database' => 'costech_rmp_db',
            'username' => 'postgres',
            'password' => '0714ki!!',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],


        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // View settings
        'uploads' => [
            'path' => __DIR__ .'/../assets/uploads/images/'
        ],

        // monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
