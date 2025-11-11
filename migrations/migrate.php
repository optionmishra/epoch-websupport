<?php

/**
 * Migration Runner Entry Point
 *
 * Main script to execute database migrations
 *
 * Usage:
 *   php migrate.php                    # Run all enabled migrations
 *   php migrate.php list               # List all migrations
 *   php migrate.php run [index]        # Run specific migration by index
 */

// Check if running from CLI
if (php_sapi_name() !== 'cli') {
    die('This script can only be run from the command line.' . PHP_EOL);
}

// Define BASEPATH before loading CodeIgniter config files
define('BASEPATH', __DIR__ . '/../system/');

// Load class files
require_once __DIR__ . '/classes/Environment.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Migration.php';
require_once __DIR__ . '/classes/MigrationManager.php';
require_once __DIR__ . '/classes/MigrationRunner.php';
require_once __DIR__ . '/classes/SetDefaultsNullMigration.php';
require_once __DIR__ . '/classes/ExampleMigration.php';

try {
    // Parse command line arguments
    $command = $argv[1] ?? 'run';
    $index = isset($argv[2]) ? (int)$argv[2] : null;

    echo "=== Database Migration Runner ===" . PHP_EOL;
    echo PHP_EOL;

    // Load .env file if it exists
    $envPath = __DIR__ . '/../.env';
    if (file_exists($envPath)) {
        echo "✓ Loading environment variables from .env file" . PHP_EOL;
        Environment::load($envPath);
        echo PHP_EOL;
    } else {
        echo "✗ WARNING: .env file not found at: $envPath" . PHP_EOL;
        echo "Will try to use hardcoded database settings from database.php" . PHP_EOL;
        echo PHP_EOL;
    }

    // Get database configuration
    $dbConfigPath = __DIR__ . '/../application/config/database.php';
    $dbConfig = Database::loadConfig($dbConfigPath);

    // Extract database settings
    $hostname = $dbConfig['hostname'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];
    $database = $dbConfig['database'];

    // Connect to database
    echo "✓ Connecting to database: $database" . PHP_EOL;
    $db = new Database([
        'hostname' => $hostname,
        'username' => $username,
        'password' => $password,
        'database' => $database,
    ]);

    // Create migration manager and runner
    $manager = new MigrationManager(__DIR__ . '/migrations.json');
    $runner = new MigrationRunner($db);

    // Handle commands
    switch ($command) {
        case 'list':
            $manager->listMigrations();
            $db->close();
            exit(0);

        case 'run':
            if ($index !== null) {
                // Run specific migration
                $runner->runFromManifest($manager, false, $index);
            } else {
                // Run all enabled migrations
                $runner->runFromManifest($manager, true);
            }
            exit(0);

        case 'help':
        default:
            echo PHP_EOL;
            echo "Usage:" . PHP_EOL;
            echo "  php migrate.php              Run all enabled migrations" . PHP_EOL;
            echo "  php migrate.php list         List all migrations" . PHP_EOL;
            echo "  php migrate.php run [index]  Run specific migration by index" . PHP_EOL;
            echo "  php migrate.php help         Show this help message" . PHP_EOL;
            echo PHP_EOL;
            $db->close();
            exit(0);
    }

} catch (Exception $e) {
    echo PHP_EOL;
    echo "✗ ERROR: " . $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
    exit(1);
}
