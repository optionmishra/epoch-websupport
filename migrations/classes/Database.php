<?php

/**
 * Database Configuration and Connection Manager
 *
 * Handles database configuration loading and connection
 */
class Database
{
    private mysqli $connection;

    /**
     * Constructor
     *
     * @param array $config Database configuration array
     * @throws Exception If connection fails
     */
    public function __construct(array $config)
    {
        $this->connection = new mysqli(
            $config['hostname'],
            $config['username'],
            $config['password'],
            $config['database']
        );

        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }

    /**
     * Get the mysqli connection
     *
     * @return mysqli
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    /**
     * Begin a transaction
     *
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->connection->begin_transaction();
    }

    /**
     * Commit a transaction
     *
     * @return void
     */
    public function commit(): void
    {
        $this->connection->commit();
    }

    /**
     * Rollback a transaction
     *
     * @return void
     */
    public function rollback(): void
    {
        $this->connection->rollback();
    }

    /**
     * Execute a query
     *
     * @param string $query SQL query
     * @return mysqli_result|bool
     * @throws Exception If query fails
     */
    public function query(string $query)
    {
        $result = $this->connection->query($query);

        if ($result === false) {
            throw new Exception("Query failed: " . $this->connection->error);
        }

        return $result;
    }

    /**
     * Close database connection
     *
     * @return void
     */
    public function close(): void
    {
        $this->connection->close();
    }

    /**
     * Load database configuration from CodeIgniter config file
     *
     * @param string $configPath Path to database.php config file
     * @return array Database configuration
     * @throws Exception If config file not found
     */
    public static function loadConfig(string $configPath): array
    {
        if (!file_exists($configPath)) {
            throw new Exception("Database configuration file not found at: $configPath");
        }

        include $configPath;

        if (!isset($db['default'])) {
            throw new Exception("Invalid database configuration format");
        }

        return $db['default'];
    }
}
