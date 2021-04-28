<?php


namespace TononT\Webentwicklung\mvc\model;

use Dotenv\Dotenv;

abstract class Connection
{

    /**
     * @var \PDO
     */
    protected \PDO $connection;

    /**
     * @return \PDO
     */
    protected function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     *
     */
    protected function connectToDb(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();

        try {
            $connection = new \PDO(
                $_ENV['DB_DSN'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );
            // set the PDO error mode to exception
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection = $connection;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}