<?php


namespace TononT\Webentwicklung\mvc\model;


class BlogPosts
{
    private $conn;
    private $table_name = "authors";

    // object properties
    public $id;
    public $name;
    public $text;
    public $date;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

}