<?php

use App\src\Application;

class m0002_posts
{

    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS post (
            id INT NOT NULL AUTO_INCREMENT,
            title TEXT NOT NULL,
            chapo VARCHAR(255) NOT NULL,
            updated_at DATETIME NOT NULL DEFAULT (DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')),
            content TEXT NOT NULL,
            id_author INT NOT NULL,
            PRIMARY KEY (id),
            CONSTRAINT fk_post_author FOREIGN KEY (id_author) REFERENCES user(id)
          );
          INSERT INTO post (title, chapo, content, id_author) VALUES (
          'Présentation', 'Bienvenu sur mon blog', 'Je suis un développeur passionné,
           constamment en quête de nouvelles innovations technologiques. J aime 
           transformer les idées complexes en solutions numériques élégantes et
            efficaces. Bienvenue sur mon blog où je partage mes aventures en codage.', 1
          );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE post";
        $db->pdo->exec($sql);
    }
}