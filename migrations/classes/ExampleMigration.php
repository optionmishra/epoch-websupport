<?php

/**
 * Example Migration Template
 *
 * This is a template for creating new migrations.
 * Copy this file, rename it, and modify the class name and implementation.
 *
 * Example usage:
 * 1. Copy this file to your new migration class file
 * 2. Rename the class from ExampleMigration to your desired name
 * 3. Update the table names, column names, and SQL as needed
 * 4. Add your migration to migrations.json
 */
class ExampleMigration extends Migration
{
    /**
     * Get migration name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Example Migration Description';
    }

    /**
     * Execute the migration
     *
     * @return void
     * @throws Exception If migration fails
     */
    public function up(): void
    {
        echo PHP_EOL;
        $this->log("=== Migration: " . $this->getName() . " ===");
        echo PHP_EOL;

        // Check if table exists
        // $tableName = 'your_table_name';
        // if (!$this->tableExists($tableName)) {
        //     throw new Exception("Table '$tableName' does not exist!");
        // }
        // $this->log("✓ Table '$tableName' exists", "  ");

        // Start transaction
        $this->db->beginTransaction();
        $this->log("✓ Started transaction", "  ");

        // Example: Add a new column
        // $this->log("Adding column 'new_column' to table '$tableName'", "  ");
        // $this->db->query("ALTER TABLE `$tableName` ADD COLUMN `new_column` VARCHAR(255) DEFAULT NULL");
        // $this->log("✓ Column added successfully", "  ");

        // Example: Update data
        // $this->log("Updating data in '$tableName'", "  ");
        // $this->db->query("UPDATE `$tableName` SET `status` = 'active' WHERE `status` IS NULL");
        // $this->log("✓ Data updated successfully", "  ");

        // Example: Run custom SQL
        // $this->log("Running custom SQL query", "  ");
        // $result = $this->db->query("SELECT COUNT(*) as count FROM `$tableName`");
        // $row = $result->fetch_assoc();
        // $this->log("Total records: " . $row['count'], "  ");

        // Commit transaction
        $this->db->commit();
        $this->log("✓ Transaction committed", "  ");

        echo PHP_EOL;
        $this->log("✓ Migration completed successfully!", "  ");
        echo PHP_EOL;
    }
}
