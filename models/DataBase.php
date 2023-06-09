<?php
namespace App\models;

use App\src\Application;

class DataBase
{

    public \PDO $pdo;

    public function __construct($config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB");
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getApplyMigrations();
        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->up();
            $newMigrations[] = $migration;

        }
        if (!empty($newMigrations)) {
            $this->saveMigration($newMigrations);
        } else {
            echo "all migration applied";
        }
    }

    public function saveMigration(array $migrations)
    {
        foreach ($migrations as $migration) {
            $query = $this->pdo->prepare("INSERT INTO migrations (migration) VALUE ('$migration')");
            $query->execute();
        }
    }

    public function getApplyMigrations()
    {
        $query = $this->pdo->prepare("SELECT migration FROM migrations");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
}