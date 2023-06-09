<?php
use App\src\Application;

class m0001_initial
{

    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE user (
            id INT NOT NULL AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            type INT NOT NULL DEFAULT 0,
            PRIMARY KEY (id)
          );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE user";
        $db->pdo->exec($sql);
    }
}