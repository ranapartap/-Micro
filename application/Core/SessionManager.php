<?php

namespace Micro\Core;

class SessionManager {


     /**
     * Set session variable
     * @param string $key (optional) Value required for key
     * @return Key value if found, Full Session if $key not set, false if session not available
     */
    public function setSessionKey($key, $value) {
           //Start the session
      if (session_id() === '')
            session_start();

        // All set return required Key value
        $_SESSION[SESSION_KEY][$key] = $value;
    }

    /**
     * Get session variable
     * @param string $key (optional) Value required for key
     * @return Key value if found, Full Session if $key not set, false if session not available
     */
    public function getSession($key = null) {
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
    public function StartSession() {
         //Start the session, if not started yet
       if (session_id() === '')
            session_start();

         //Set default session
        if( !isset($_SESSION[SESSION_KEY]) )
            $_SESSION[SESSION_KEY] = [];
    }


    /**
     * Start the session if not started
     */
    public function clearSession() {
         //Start the session, if not started yet
       if (session_id() === '')
            session_start();

       unset($_SESSION[SESSION_KEY]);
    }



}
