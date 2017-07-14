<?php

namespace Micro\Core;

class Old {

    private $_vals;

    public function __construct() {
        $this->_vals =  \Micro\Core\SessionManager::getSession('old');
    }

    public function __destruct() {
        $this->clear();
    }

    public static function set() {
        SessionManager::setSession('old', $_REQUEST);
    }

    public function value($filed_name, $default_val = '') {
        echo $this->get_value($filed_name, $default_val);
    }

    public function get_value($filed_name, $default_val = '') {
        if (isset($this->_vals[$filed_name]) && !empty($this->_vals[$filed_name]))
            return $this->_vals[$filed_name];
        else
            return $default_val;
    }

    public function clear() {
        unset($this->_vals);
        return true;
    }

}

?>