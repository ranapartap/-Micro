<?php

namespace Micro\Core;

use PDO;
use NotORM;

class Model {

    public $connection = null;

    /**
     * When model is created, open database connection.
     */
    function __construct() {
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            error_log("Connection error: " . $e->getMessage());
            error_exit('Database connection could not be established.', $e->getMessage());
        }
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection() {
        //Connection options
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        //Open database connection
//        $this->connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        $this->connection = new NotORM(new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options));
    }

    /**
     * Execute query string like INSERT/UPDATE/DELETE query. Not limited to these queries any query string can be executed.
     * @param string $sQuery MySql query string
     * @param array $aVars (optional) Array of variables to be supplied to query
     * @return Mixed lastInsertId() when query on INSERT success, true on success for other queries, false on failure
     */
    public function executeQuery($sQuery, $aVars = null) {
        try {

            $sQuery = trim($sQuery);
            $obj = $this->connection->prepare($sQuery);

            if ($obj->execute($aVars))
                return (strtoupper(substr($sQuery, 0, 6)) == "INSERT" ) ? $obj->lastInsertId() : true;
            else
                return false;

        } catch (PDOException $exc) {

            echo $exc->getMessage();
            error_log("DB Query Error: " . $exc->getMessage());
            throw $exc;

        }

        return false;
    }

    /**
     * Get a single variable from table row
     * @param string $sQuery MySql query string
     * @param array $aVars (optional) Array of variables to be supplied to query
     * @return Mixed Table field value on success, false on failure
     */
    public function getVar($sQuery, $aVars = null) {
        try {

            $obj = $this->connection->prepare($sQuery);
            $obj->execute($aVars);

            $result = $obj->fetch(PDO::FETCH_NUM);

            return $result[0];
        } catch (PDOException $exc) {

            echo $exc->getMessage();
            error_log("DB Query Error: " . $exc->getMessage());
            throw $exc;

        }
        return false;
    }

    /**
     * Get a single row from table
     * @param string $sQuery MySql query string
     * @param array $aVars (optional) Array of variables to be supplied to query
     */
    public function getRow($sQuery, $aVars = null) {
        try {

            $obj = $this->connection->prepare($sQuery);
            $obj->execute($aVars);

            return $obj->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $exc) {

            echo $exc->getMessage();
            error_log("DB Query Error: " . $exc->getMessage());
            throw $exc;

        }
        return false;
    }

    /**
     * Get multiple rows from table
     * @param string $sQuery MySql query string
     * @param array $aVars (optional) Array of variables to be supplied to query
     */
    public function getRows($sQuery, $aVars = null) {
        try {

            $obj = $this->connection->prepare($sQuery);
            $obj->execute($aVars);

            return $obj->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $exc) {

            echo $exc->getMessage();
            error_log("DB Query Error: " . $exc->getMessage());
            throw $exc;

        }
        return false;
    }

}
