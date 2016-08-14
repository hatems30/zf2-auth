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
return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    "db" => array(
        "username" => "root",
        "password" => "",
        "driver" => "Pdo",
        "dsn" => "mysql:dbname=zf2;host=localhost",
        "driver_options" => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'zf2',
                ),
                'doctrine_type_mappings' => array(
                    'enum' => 'string',
                ),
            ),
        ),
    ),
    'web' => array(
        'host' => 'http://storexpo.local',
    ),
    'phpSettings' => array(
        'display_startup_errors' => false,
        'display_errors' => false,
        'error_reporting' => 'E_ALL & ~E_NOTICE',
        'max_execution_time' => 60,
        'date.timezone' => 'UTC',
        'mbstring.internal_encoding' => 'UTF-8',
    ),
    'session' => array(
        'cookie_lifetime' => 900,
        'remember_me_seconds' => 900,
        'use_cookies' => true,
        'cookie_httponly' => true,
    ),
);
