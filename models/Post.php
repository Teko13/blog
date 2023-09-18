<?php

namespace App\models;

use App\models\DBModel;

class Post extends DBModel
{
    public int $id;
    public string $title;
    public string $chapo;
    public string $updated_at;
    public string $content;
    public int $id_author;
    public function tableName(): string
    {
        return 'post';
    }
    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED],
            'title' => [self::RULE_REQUIRED],
            'chapo' => [self::RULE_REQUIRED],
        ];
    }
    public function attributes()
    {
        return ["title", "chapo", "content", "id_author"];
    }

    public function findOnePost($idPost)
    {
        $sql = "SELECT post.*, user.firstName AS user_firstName, user.lastName AS user_lastName FROM post
                INNER JOIN user ON post.id_author = user.id
                WHERE post.id = :post_id";
        $params = [":post_id" => $idPost];
        return $this->findInMultiTable($sql, $params);
    }
}
