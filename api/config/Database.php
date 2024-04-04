<?php

require_once 'config/Environment.php';

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        Environment::loadEnv();

        $host = Environment::get('DB_HOST');
        $db_name = Environment::get('DB_NAME');
        $username = Environment::get('DB_USER');
        $password = Environment::get('DB_PASSWORD');


        try {
            $this->connection = new PDO('pgsql:host=' . $host . ';dbname=' . $db_name, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    // Generic method for executing SQL queries
    public function executeQuery($query, $params = [])
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
