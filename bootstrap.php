<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;

use TononT\Webentwicklung\mvc\model\Connection;

$dbConnection = (new Connection())->getConnection();