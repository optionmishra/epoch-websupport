<?php

/**
 * Abstract Migration Base Class
 *
 * Provides common functionality for database migrations
 */
abstract class Migration
{
    protected Database $db;
    protected mysqli $connection;

    /**
     * Constructor
     *
     * @param Database $database Database connection instance
     */
    public function __construct(Database $database)
    {
        $this->db = $database;
        $this->connection = $database->getConnection();
    }

    /**
     * Get migration name/description
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Execute the migration
     *
     * @return void
     * @throws Exception If migration fails
     */
    abstract public function up(): void;

    /**
     * Check if a table exists
     *
     * @param string $tableName Table name
     * @return bool
     * @throws Exception If query fails
     */
    protected function tableExists(string $tableName): bool
    {
        $result = $this->db->query("SHOW TABLES LIKE '$tableName'");
        return $result->num_rows > 0;
    }

    /**
     * Get table columns information
     *
     * @param string $tableName Table name
     * @param array $columns Column names to fetch (optional)
     * @return array Array of column information
     * @throws Exception If query fails
     */
    protected function getTableColumns(string $tableName, array $columns = []): array
    {
        $whereClause = '';

        if (!empty($columns)) {
            $escapedColumns = array_map(function($col) {
                return "'" . $this->connection->real_escape_string($col) . "'";
            }, $columns);
            $whereClause = " WHERE Field IN (" . implode(', ', $escapedColumns) . ")";
        }

        $result = $this->db->query("SHOW COLUMNS FROM `$tableName`" . $whereClause);

        $columnInfo = [];
        while ($row = $result->fetch_assoc()) {
            $columnInfo[$row['Field']] = $row;
        }

        return $columnInfo;
    }

    /**
     * Display formatted message
     *
     * @param string $message Message to display
     * @param string $prefix Prefix (e.g., "✓", "✗")
     * @return void
     */
    protected function log(string $message, string $prefix = '  '): void
    {
        echo $prefix . $message . PHP_EOL;
    }
}
