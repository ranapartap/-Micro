<?php

define('SITE_TITLE_DESC', 'Micro - a quickstart Core PHP skeleton application.');
define('SITE_TITLE', 'Micro');
define('SITE_TITLE_MINI', 'MI');

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

//New registered user role type
const NEW_REG_USER_ROLE_ID = 1;

//Use password encryption (Old saved user passwords become invalid)
const PASSWORD_ENCRYPTION = FALSE;

const DATE_FORMAT_LONG = "d M Y g:i:sa";
const DATE_FORMAT_SHORT = "d-M-y g:i:sa";
const DATE_FORMAT_NO_SECONDS = "d-M-Y g:ia";
const DATE_FORMAT_DATE = "d-M-Y";

const POST_TYPE_PAGE = 1;
const POST_TYPE_POST = 2;
const POST_TYPE_ARRAY = [POST_TYPE_PAGE => "Page", POST_TYPE_POST => "Post"];

// set user roles
const ROLE_USER         = 1;
const ROLE_ADMIN        = 2;
const ROLE_ARRAY        = [ROLE_USER => "USER", ROLE_ADMIN => "ADMIN"];

//API Request Methods
const METHOD_GET        = "GET";
const METHOD_POST       = "POST";
const METHOD_PUT        = "PUT";
const METHOD_DELETE     = "DELETE";
const METHOD_OPTIONS    = "OPTIONS";