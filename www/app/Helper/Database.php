<?php

/*
* class contains database management functions used all over the script
*/
class Database extends Common {

    protected $db;
    function __construct(){
        $this->openDatabaseConnection();
    }

    function __destruct() {
        $this->closeDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        try {
            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }    
    }

    private function closeDatabaseConnection()
    {
        $this->db = null  ;
    }

}