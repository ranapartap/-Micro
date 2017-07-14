<?php

namespace Micro\Core;

class SessionManager {

     /**
     * Set session variable
     * @param string $key (optional) Value required for key
     * @return Key value if found, Full Session if $key not set, false if session not available
     */
    public static function setSession($key, $value) {
           //Start the session
      if (session_id() === '')
            session_start();

        // All set return required Key value
        $_SESSION[SESSION_KEY][$key] = $value;

        return;
    }

    /**
     * Get session variable
     * @param string $key (optional) Value required for key
     * @return Key value if found, Full Session if $key not set, false if session not available
     */
    public static function getSession($key = null) {
        //Start the session
       if (session_id() === '')
            session_start();

        // Session/Key is not set
        if (!isset($_SESSION[SESSION_KEY]) )
            return false;

        // $key is not provided, return full session
        if(!$key)
            return arrayToObject($_SESSION[SESSION_KEY]);

        // $key not exist
        if(!isset($_SESSION[SESSION_KEY][$key]))
            return false;

        return $_SESSION[SESSION_KEY][$key];
    }

    /**
     * Start the session if not started
     */
    public static function StartSession() {
         //Start the session, if not started yet
       if (session_id() === '')
            session_start();

         //Set default session
        if( !isset($_SESSION[SESSION_KEY]) )
            $_SESSION[SESSION_KEY] = [];

        return;
    }


    /**
     * Start the session if not started
     */
    public static function clearSession($key = null) {
         //Start the session, if not started yet
       if (session_id() === '')
            session_start();

       if($key)
            unset($_SESSION[SESSION_KEY][$key]);
       else
           unset($_SESSION[SESSION_KEY]);

       return;
    }

    /**
     * Unset the session/key and return its value
     * @param mixed $key Get and flash session key
     * @return mixed $key value as object
     */
    public static function flushSession($key = null) {
         //Start the session, if not started yet
       if (session_id() === '')
            session_start();

       $val = self::getSession($key);
       
       if($key)
            unset($_SESSION[SESSION_KEY][$key]);
       else
           unset($_SESSION[SESSION_KEY]);

       return $val;
    }


}
