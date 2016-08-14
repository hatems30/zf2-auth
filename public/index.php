<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */


ini_set('memory_limit', '512M'); 
ini_set('display_errors', true);
error_reporting(E_ALL);
chdir(dirname(__DIR__));
date_default_timezone_set("CET");
define('EXPOSE_ATTACHMENTS_UPLOAD_PATH', './public/uploads/expose/attachments/');
define('NEWS_ATTACHMENTS_UPLOAD_PATH', './public/uploads/news/attachments/');
define('EXPOSE_DOWNLOAD_PATH', '/uploads/expose/attachments/');
define('NEWS_DOWNLOAD_PATH', '/uploads/news/attachments/');

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
