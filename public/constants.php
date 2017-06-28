<?php

define('SITE_TITLE', 'My Great Sites');
define('SIDEBAR_TITLE', 'Admin');

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// set a constant that holds the project's "Views" folder, like "/var/www/application".
define('PATH_VIEW', APP . 'view' . DIRECTORY_SEPARATOR);

// set a constant that holds the project's "libs" folder, like "/var/www/application".
define('PATH_LIB', APP . 'libs' . DIRECTORY_SEPARATOR);
define('PATH_LIBS', PATH_LIB);
define('PATH_LIBRARY', PATH_LIB);

// set a constant that holds the Session key to avoid any $_SESSION Conflicts
// our session will use this key to hold session variables
define('SESSION_KEY', 'myapp');

// define URL seperator
define('URL_SEPARATOR', '/');

// define default post slash seperater
define('URL_ADD_POST_SLASH', FALSE);

// base URL for admin user
define('ADMIN_BASE', 'home');

// set user roles
const ROLE_USER = 0;
const ROLE_ADMIN = 1;
const ROLE_ARRAY = [ROLE_USER => "USER", ROLE_ADMIN => "ADMIN"];