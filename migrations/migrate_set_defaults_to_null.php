<?php

/**
 * Migration Script: Set default value to NULL for classes and subject columns in web_user table
 *
 * Usage:
 *   php migrate_set_defaults_to_null.php
 *
 * This script sets the default value to NULL for the 'classes' and 'subject' columns
 * in the 'web_user' table.
 */

// Check if running from CLI
if (php_sapi_name() !== 'cli') {
    die('This script can only be run from the command line.' . PHP_EOL);
}

echo "=== Migration: Set Default NULL for web_user columns ===" . PHP_EOL;
echo PHP_EOL;

// Load .env file if it exists
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    echo "✓ Loading environment variables from .env file" . PHP_EOL;
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        // Parse KEY=VALUE pairs
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            // Set environment variable
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
    echo PHP_EOL;
} else {
    echo "✗ WARNING: .env file not found at: $envPath" . PHP_EOL;
    echo "Will try to use hardcoded database settings from database.php" . PHP_EOL;
    echo PHP_EOL;
}

// Define BASEPATH before loading CodeIgniter config files
define('BASEPATH', __DIR__ . '/system/');

// Get database configuration from config/database.php
$dbConfigPath = __DIR__ . '/application/config/database.php';

if (!file_exists($dbConfigPath)) {
    echo "✗ ERROR: Database configuration file not found at: $dbConfigPath" . PHP_EOL;
    exit(1);
}

// Load database configuration
include $dbConfigPath;

// Extract database settings
$hostname = $db['default']['hostname'];
$username = $db['default']['username'];
$password = $db['default']['password'];
$database = $db['default']['database'];

try {
    // Connect to database
    $mysqli = new mysqli($hostname, $username, $password, $database);

    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: $mysqli->connect_error");
    }

    echo "✓ Successfully connected to database: $database" . PHP_EOL;

    // Check if web_user table exists
    $result = $mysqli->query("SHOW TABLES LIKE 'web_user'");
    if ($result->num_rows === 0) {
        throw new Exception("Table 'web_user' does not exist!");
    }
    echo "✓ Table 'web_user' exists" . PHP_EOL;

    // Start transaction
    $mysqli->begin_transaction();
    echo "✓ Started transaction" . PHP_EOL;

    // Get current column information
    $result = $mysqli->query("SHOW COLUMNS FROM web_user WHERE Field IN ('classes', 'subject')");

    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[$row['Field']] = $row;
    }

    echo PHP_EOL;
    echo "Current column definitions:" . PHP_EOL;
    foreach ($columns as $colName => $colInfo) {
        echo "  - {$colName}: {$colInfo['Type']} | Default: " . ($colInfo['Default'] === null ? 'NULL' : $colInfo['Default']) . " | Null: {$colInfo['Null']} | Key: {$colInfo['Key']}" . PHP_EOL;
    }
    echo PHP_EOL;

    // Modify columns to set default to NULL
    $modifications = [];

    if (isset($columns['classes'])) {
        $modifications[] = "MODIFY COLUMN `classes` {$columns['classes']['Type']} DEFAULT NULL";
        echo "Will modify column 'classes' to have DEFAULT NULL" . PHP_EOL;
    }

    if (isset($columns['subject'])) {
        $modifications[] = "MODIFY COLUMN `subject` {$columns['subject']['Type']} DEFAULT NULL";
        echo "Will modify column 'subject' to have DEFAULT NULL" . PHP_EOL;
    }

    if (empty($modifications)) {
        echo "No modifications needed. Both columns already have correct default values or don't exist." . PHP_EOL;
    } else {
        echo PHP_EOL;

        // Execute ALTER TABLE
        $alterQuery = "ALTER TABLE `web_user` " . implode(', ', $modifications);

        if ($mysqli->query($alterQuery)) {
            echo "✓ Successfully altered table" . PHP_EOL;
        } else {
            throw new Exception("Error altering table: " . $mysqli->error);
        }

        // Commit transaction
        $mysqli->commit();
        echo "✓ Transaction committed" . PHP_EOL;

        // Verify changes
        echo PHP_EOL;
        echo "Verification - New column definitions:" . PHP_EOL;
        $result = $mysqli->query("SHOW COLUMNS FROM web_user WHERE Field IN ('classes', 'subject')");
        while ($row = $result->fetch_assoc()) {
            echo "  - {$row['Field']}: {$row['Type']} | Default: " . ($row['Default'] === null ? 'NULL' : $row['Default']) . " | Null: {$row['Null']} | Key: {$row['Key']}" . PHP_EOL;
        }
    }

    echo PHP_EOL;
    echo "✓ Migration completed successfully!" . PHP_EOL;
    echo PHP_EOL;

    $mysqli->close();

} catch (Exception $e) {
    // Rollback on error
    if (isset($mysqli) && $mysqli->connect_error === null) {
        $mysqli->rollback();
        $mysqli->close();
    }

    echo PHP_EOL;
    echo "✗ ERROR: " . $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
    exit(1);
}
