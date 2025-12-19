<?php

/**
 * Environment Variable Loader
 *
 * Loads environment variables from .env file
 */
class Environment
{
    /**
     * Load environment variables from .env file
     *
     * @param string $path Path to .env file
     * @return void
     * @throws Exception If .env file cannot be read
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            throw new Exception(".env file not found at: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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
    }
}
