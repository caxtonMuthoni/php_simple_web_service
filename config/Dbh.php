<?php 
namespace config;

use Exception;
use PDO;

class Dbh {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "blog";

    protected function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName;";
            $pdo = new PDO($dsn, $this->user, $this->password);
            return $pdo;
        } catch (Exception $ex) {
            die("Error occured :( {$ex->getMessage()}");
        }
    }
}