<?php
use App\src\Application;

class m0003_comment
{

    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE comment (
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NOT NULL DEFAULT (DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')),
            content TEXT NOT NULL,
            status VARCHAR(255) NOT NULL DEFAULT 'invalid',
            id_post INT NOT NULL,
            id_author INT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (id_post) REFERENCES post(id) ON DELETE CASCADE,
            FOREIGN KEY (id_author) REFERENCES user(id)
          );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE comment";
        $db->pdo->exec($sql);
    }
}