<?php

/**
 * Migration Runner
 *
 * Executes database migrations
 */
class MigrationRunner
{
    private Database $database;

    /**
     * Constructor
     *
     * @param Database $database Database connection instance
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Run a single migration
     *
     * @param Migration $migration Migration instance to execute
     * @return void
     */
    public function runMigration(Migration $migration): void
    {
        try {
            $migration->up();
        } catch (Exception $e) {
            $this->database->rollback();
            $this->database->close();

            echo PHP_EOL;
            echo "✗ ERROR: " . $e->getMessage() . PHP_EOL;
            echo PHP_EOL;
            exit(1);
        }

        $this->database->close();
    }

    /**
     * Run multiple migrations from manifest
     *
     * @param MigrationManager $manager Migration manager instance
     * @param bool $all Run all enabled migrations (default: true)
     * @param int|null $index Run specific migration by index (optional)
     * @return void
     */
    public function runFromManifest(MigrationManager $manager, bool $all = true, ?int $index = null): void
    {
        $migrations = $manager->getEnabledMigrations();

        if (empty($migrations)) {
            echo "No enabled migrations found." . PHP_EOL;
            return;
        }

        if ($index !== null) {
            // Run specific migration by index
            if ($index < 1 || $index > count($migrations)) {
                throw new Exception("Invalid migration index: $index");
            }

            $migrationConfig = $migrations[$index - 1];
            echo PHP_EOL;
            echo "Running migration: {$migrationConfig['class']}" . PHP_EOL;
            echo PHP_EOL;

            $migration = $manager->loadMigration($migrationConfig['class'], $this->database);
            $this->runMigration($migration);
        } elseif ($all) {
            // Run all enabled migrations
            echo "Running all enabled migrations..." . PHP_EOL;
            echo PHP_EOL;

            foreach ($migrations as $migrationConfig) {
                echo "---" . PHP_EOL;
                echo "Migration: {$migrationConfig['class']}" . PHP_EOL;
                echo "---" . PHP_EOL;

                $migration = $manager->loadMigration($migrationConfig['class'], $this->database);
                $this->runMigration($migration);

                echo PHP_EOL;
            }

            echo "✓ All migrations completed successfully!" . PHP_EOL;
            echo PHP_EOL;
        }
    }
}
