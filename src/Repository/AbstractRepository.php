<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use Dotenv\Dotenv;
use PDO;

/**
 * Class AbstractRepository
 * @package TononT\Webentwicklung\Repository
 */
abstract class AbstractRepository
{

    /**
     * @var PDO
     */
    protected PDO $connection;

    /**
     * BlogPostRepository constructor.
     */
    public function __construct()
    {
        $this->connectToDb();
    }


    /**
     * @return PDO
     */
    protected function getConnection(): PDO
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
            $connection = new PDO(
                $_ENV['DB_DSN'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $connection;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}