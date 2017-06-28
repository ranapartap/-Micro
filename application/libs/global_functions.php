<?php

//namespace Micro\Libs;
//use Micro\Core\SessionManager;

/**
 * Get directory path
 * @param string $directory
 * @return absolute path to the directory specified
 */
function getPath($directory) {

    switch (strtolower($directory)) {
        case 'view':
        case 'views':
            return PATH_VIEW;
            break;

        case 'lib':
        case 'libs':
        case 'library':
            return PATH_LIB;
            break;
    }

    return '';
}

/**
 * Get url for given path
 * @param string $path
 * @param string $add_post_slash (optional) default true, Weather slash at the end of url
 * @return string Full url to the path
 */
function get_url($path, $add_post_slash = true) {

    return URL . $path . ($add_post_slash ? URL_SEPARATOR : '' );
}

/**
 * Get Admin Base url
 * @param type $path Add path to admin url
 * @param string $add_post_slash (optional) default true, Weather slash at the end of url
 * @return string Full url to the ADMIN path
 */
function admin_url($path = null, $add_post_slash = true) {

    return URL . ADMIN_BASE . ($path && $path != '' ? URL_SEPARATOR . $path : '') . ($add_post_slash && URL_ADD_POST_SLASH ? URL_SEPARATOR : '' );
}

/**
 * Chack current admin url and supplied path is same
 * @param type $path to compare
 * @return boolean Success on compare success
 */
function curent_url_verify($path = null) {
    return ltrim(URI, '/') == ADMIN_BASE . ($path && $path != '' ? URL_SEPARATOR . $path : '');
}

function get_username($id = null) {
    $session = new \Micro\Core\SessionManager();
    if (!$id and isset($session->getSession()->user->user_name)) {
        return $session->getSession()->user->user_name;
    }

    return '';
}

/**
 * Get Base url for the application
 * @return string Full url to the application
 */
function getBaseUrl() {

    return URL;
}

/**
 * Debug Print n Die Function
 */
function dd($var, $can_die = false) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    if ($can_die)
        die();
}

function arrayToObject($d) {
    if (is_array($d)) {
        return (object) array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

function error_exit($error, $description = null) {
    ?>
    <style>
        .content {
                -webkit-font-smoothing: antialiased;
            font-family: Georgia, serif;
            width: 90%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            background-color: rgba(249, 249, 249, 0.96);
        }

    </style>

    <div class="content">
            <h2><?= $error ?></h2>
            <?= $description ? "<p>".$description."</p>":'' ?>
    </div>
    <?php
    exit;

}
