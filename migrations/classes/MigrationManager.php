<?php

/**
 * Migration Manager
 *
 * Manages migrations from manifest configuration
 */
class MigrationManager
{
    private array $migrations = [];
    private string $manifestPath;

    /**
     * Constructor
     *
     * @param string $manifestPath Path to migrations manifest file
     */
    public function __construct(string $manifestPath)
    {
        $this->manifestPath = $manifestPath;
        $this->loadManifest();
    }

    /**
     * Load migrations from manifest file
     *
     * @return void
     * @throws Exception If manifest file is invalid
     */
    private function loadManifest(): void
    {
        if (!file_exists($this->manifestPath)) {
            throw new Exception("Migration manifest not found at: $this->manifestPath");
        }

        $json = file_get_contents($this->manifestPath);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON in migration manifest: " . json_last_error_msg());
        }

        if (!isset($data['migrations']) || !is_array($data['migrations'])) {
            throw new Exception("Invalid migration manifest format: 'migrations' key not found");
        }

        $this->migrations = $data['migrations'];
    }

    /**
     * Get list of enabled migrations
     *
     * @return array List of enabled migrations with their details
     */
    public function getEnabledMigrations(): array
    {
        return array_filter($this->migrations, function($migration) {
            return $migration['enabled'] ?? true;
        });
    }

    /**
     * Load a migration class by name
     *
     * @param string $className Migration class name
     * @param Database $database Database connection
     * @return Migration Migration instance
     * @throws Exception If migration class not found
     */
    public function loadMigration(string $className, Database $database): Migration
    {
        $classPath = __DIR__ . '/' . $className . '.php';

        if (!file_exists($classPath)) {
            throw new Exception("Migration class file not found: $classPath");
        }

        require_once $classPath;

        if (!class_exists($className)) {
            throw new Exception("Migration class '$className' not found in $classPath");
        }

        return new $className($database);
    }

    /**
     * List all migrations with their status
     *
     * @return void
     */
    public function listMigrations(): void
    {
        echo PHP_EOL;
        echo "Available migrations:" . PHP_EOL;
        echo PHP_EOL;

        foreach ($this->migrations as $index => $migration) {
            $enabled = $migration['enabled'] ?? true;
            $status = $enabled ? '✓' : '✗';
            $statusText = $enabled ? 'enabled' : 'disabled';

            echo sprintf(
                "%d. [%s] %s (%s)" . PHP_EOL,
                $index + 1,
                $status,
                $migration['class'],
                $statusText
            );

            if (isset($migration['description'])) {
                echo "   " . $migration['description'] . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}
