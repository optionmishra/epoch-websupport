<?php

/**
 * Set Defaults NULL Migration
 *
 * Sets default value to NULL for classes and subject columns in web_user table
 */
class SetDefaultsNullMigration extends Migration
{
    private const TABLE_NAME = 'web_user';
    private const COLUMNS = ['classes', 'subject'];

    /**
     * Get migration name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Set Default NULL for web_user columns';
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
        if (!$this->tableExists(self::TABLE_NAME)) {
            throw new Exception("Table '" . self::TABLE_NAME . "' does not exist!");
        }

        $this->log("✓ Table '" . self::TABLE_NAME . "' exists", "  ");

        // Start transaction
        $this->db->beginTransaction();
        $this->log("✓ Started transaction", "  ");

        // Get current column information
        $columns = $this->getTableColumns(self::TABLE_NAME, self::COLUMNS);

        $this->log(PHP_EOL . "Current column definitions:", "  ");
        foreach ($columns as $colName => $colInfo) {
            $defaultValue = $colInfo['Default'] === null ? 'NULL' : $colInfo['Default'];
            $this->log("  - {$colName}: {$colInfo['Type']} | Default: {$defaultValue} | Null: {$colInfo['Null']} | Key: {$colInfo['Key']}", "    ");
        }
        echo PHP_EOL;

        // Modify columns to set default to NULL
        $modifications = [];

        if (isset($columns['classes'])) {
            $modifications[] = "MODIFY COLUMN `classes` {$columns['classes']['Type']} DEFAULT NULL";
            $this->log("Will modify column 'classes' to have DEFAULT NULL", "  ");
        }

        if (isset($columns['subject'])) {
            $modifications[] = "MODIFY COLUMN `subject` {$columns['subject']['Type']} DEFAULT NULL";
            $this->log("Will modify column 'subject' to have DEFAULT NULL", "  ");
        }

        if (empty($modifications)) {
            $this->log("No modifications needed. Both columns already have correct default values or don't exist.", "  ");
        } else {
            echo PHP_EOL;

            // Execute ALTER TABLE
            $alterQuery = "ALTER TABLE `" . self::TABLE_NAME . "` " . implode(', ', $modifications);

            if ($this->db->query($alterQuery)) {
                $this->log("✓ Successfully altered table", "  ");
            } else {
                throw new Exception("Error altering table: " . $this->db->getConnection()->error);
            }

            // Commit transaction
            $this->db->commit();
            $this->log("✓ Transaction committed", "  ");

            // Verify changes
            echo PHP_EOL;
            $this->log("Verification - New column definitions:", "  ");
            $result = $this->db->query("SHOW COLUMNS FROM `" . self::TABLE_NAME . "` WHERE Field IN ('classes', 'subject')");
            while ($row = $result->fetch_assoc()) {
                $defaultValue = $row['Default'] === null ? 'NULL' : $row['Default'];
                $this->log("  - {$row['Field']}: {$row['Type']} | Default: {$defaultValue} | Null: {$row['Null']} | Key: {$row['Key']}", "    ");
            }
        }

        echo PHP_EOL;
        $this->log("✓ Migration completed successfully!", "  ");
        echo PHP_EOL;
    }
}
