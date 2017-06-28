<?php
/**
 * Configuration
 */

/**
 * Configuration for: Error reporting
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * URL declaration for global use
 */
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
//define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
//define('URL', $_SERVER['HTTP_HOST'].'/');

/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'micro');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

define('URI', rtrim( isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']:'', '/'));

