<?php
use App\src\Application;

class m0001_initial
{

    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE user (
            id INT NOT NULL AUTO_INCREMENT,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            type INT NOT NULL DEFAULT 0,
            PRIMARY KEY (id)
          );";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE user";
        $db->pdo->exec($sql);
    }
}
