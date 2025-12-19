# Database Migration System

A flexible and easy-to-use database migration system for your project.

## Features

- **Easy Migration Management**: Simple JSON-based configuration for migrations
- **Flexible Execution**: Run all migrations at once or specific ones individually
- **Clean Code Structure**: Object-oriented design with separation of concerns
- **Transaction Safety**: Automatic rollback on errors
- **Easy to Extend**: Simple template for creating new migrations

## File Structure

```
migrations/
├── migrate.php                    # Main entry script
├── migrations.json                # Migration configuration
├── README.md                      # This file
└── classes/
    ├── Environment.php            # Environment variable loader
    ├── Database.php               # Database connection manager
    ├── Migration.php              # Abstract migration base class
    ├── MigrationManager.php       # Migration manifest manager
    ├── MigrationRunner.php        # Migration execution handler
    ├── SetDefaultsNullMigration.php  # Example migration implementation
    └── ExampleMigration.php       # Template for new migrations
```

## Usage

### List Available Migrations

```bash
php migrations/migrate.php list
```

This shows all migrations with their status (enabled/disabled):

```
Available migrations:

1. [✓] SetDefaultsNullMigration (enabled)
   Set default value to NULL for classes and subject columns in web_user table
```

### Run All Enabled Migrations

```bash
php migrations/migrate.php
```

Or explicitly:

```bash
php migrations/migrate.php run
```

### Run a Specific Migration

```bash
php migrations/migrate.php run 1
```

Where `1` is the index number from the `list` command.

### Show Help

```bash
php migrations/migrate.php help
```

## Adding a New Migration

### Step 1: Create Migration Class

Copy the example template:

```bash
cp migrations/classes/ExampleMigration.php migrations/classes/YourNewMigration.php
```

Edit `YourNewMigration.php` and update:
- Class name (e.g., `YourNewMigration`)
- Migration name in `getName()` method
- Migration logic in `up()` method

**Example:**

```php
<?php

class AddUserEmailColumn extends Migration
{
    public function getName(): string
    {
        return 'Add email column to users table';
    }

    public function up(): void
    {
        $this->db->beginTransaction();
        $this->log("✓ Started transaction", "  ");

        // Add column
        $this->db->query("ALTER TABLE `users` ADD COLUMN `email` VARCHAR(255) DEFAULT NULL");
        $this->log("✓ Column added successfully", "  ");

        $this->db->commit();
        $this->log("✓ Transaction committed", "  ");

        echo PHP_EOL;
        $this->log("✓ Migration completed successfully!", "  ");
        echo PHP_EOL;
    }
}
```

### Step 2: Add to Configuration

Edit `migrations/migrations.json` and add your migration:

```json
{
  "migrations": [
    {
      "class": "SetDefaultsNullMigration",
      "description": "Set default value to NULL for classes and subject columns in web_user table",
      "enabled": true
    },
    {
      "class": "AddUserEmailColumn",
      "description": "Add email column to users table",
      "enabled": true
    }
  ]
}
```

### Step 3: Run the Migration

```bash
php migrations/migrate.php list
php migrations/migrate.php run 2  # Run the new migration
```

## Removing a Migration

### Method 1: Disable (Recommended)

Edit `migrations/migrations.json` and set `enabled` to `false`:

```json
{
  "migrations": [
    {
      "class": "SetDefaultsNullMigration",
      "description": "Set default value to NULL...",
      "enabled": false
    }
  ]
}
```

The migration won't run but remains in history.

### Method 2: Remove Completely

1. Delete the migration class file: `rm migrations/classes/YourMigration.php`
2. Remove it from `migrations.json`

## Migration Template Guide

When creating a migration, you have access to these helper methods:

### Available Methods

- `$this->db->beginTransaction()` - Start a transaction
- `$this->db->commit()` - Commit the transaction
- `$this->db->rollback()` - Rollback the transaction
- `$this->db->query($sql)` - Execute a SQL query
- `$this->tableExists($tableName)` - Check if a table exists
- `$this->getTableColumns($tableName, $columns)` - Get column information
- `$this->log($message, $prefix)` - Display a formatted message

### Example Migration Patterns

#### Add a Column

```php
$this->log("Adding column 'email' to users table", "  ");
$this->db->query("ALTER TABLE `users` ADD COLUMN `email` VARCHAR(255) DEFAULT NULL");
$this->log("✓ Column added successfully", "  ");
```

#### Update Data

```php
$this->log("Updating user statuses", "  ");
$this->db->query("UPDATE `users` SET `status` = 'active' WHERE `status` IS NULL");
$this->log("✓ Data updated successfully", "  ");
```

#### Check Table Structure

```php
$columns = $this->getTableColumns('users', ['email', 'status']);
foreach ($columns as $colName => $colInfo) {
    echo "Column: $colName, Type: {$colInfo['Type']}" . PHP_EOL;
}
```

## Best Practices

1. **Always use transactions** for data modification migrations
2. **Test migrations** on a development database first
3. **Use descriptive names** for your migrations
4. **Keep migrations atomic** - one migration should do one thing
5. **Check table/column existence** before modifying them
6. **Use backticks** around table and column names in SQL queries

## Troubleshooting

### Error: "Migration class file not found"

Make sure your migration class file is in `migrations/classes/` directory and matches the class name in `migrations.json`.

### Error: "Table does not exist"

Verify the table name is correct and the table exists in your database.

### Error: "Query failed"

Check your SQL syntax and ensure the database user has proper permissions.

## Database Configuration

The system uses CodeIgniter's database configuration file:
- `application/config/database.php`

Or environment variables from `.env` file (if available).

## Requirements

- PHP 7.4+
- mysqli extension
- MySQL/MariaDB database

## License

This migration system is provided as-is for your project.
