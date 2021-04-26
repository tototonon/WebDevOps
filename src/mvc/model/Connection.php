<?php


namespace TononT\Webentwicklung\api\config;
use PDO;
use PDOException;

class Connection
{
    // specify your own database credentials
    private $conn = null;

    // get the database connection
    public function getConnection(){

        try{
          $this->conn = new PDO("mysql:host=localhost;dbname=api_db","timonTonon","420");
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}