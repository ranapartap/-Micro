<?php

/**
 * MINI - an extremely simple naked PHP application
 *
 * @package micro
 * @author Panique
 * @link http://www.php-micro.com
 * @link https://github.com/panique/micro/
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Now MINI work with namespaces + composer's autoloader (PSR-4)
 *
 * @author Joao Vitor Dias <joaodias@noctus.org>
 *
 * For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php
 */


// This is the auto-loader for Composer-dependencies (to load tools into your project).
require 'constants.php';

// This is the auto-loader for Composer-dependencies (to load tools into your project).
require ROOT . 'vendor/autoload.php';

// load application config (error reporting etc.)
require APP . 'config/config.php';

// load application config (error reporting etc.)
require PATH_LIB . 'global_functions.php';

// Load Application menus
require APP . 'config/menus.php';

define('URL', site_url());

// load application class
use Micro\Core\Application;

// start the application
$app = new Application();
