<?php

namespace App\models;

use App\models\DBModel;


class Comment extends DBModel
{
    public int $id;
    public string $created_at;
    public string $content;
    public string $status;
    public int $id_post;
    public int $id_author;

    public function tableName(): string
    {
        return 'comment';
    }
    public function attributes()
    {
        return ["content", "id_post", "id_author"];
    }
    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED]
        ];
    }

    public function findPostComments($idPost)
    {
        $sql = "SELECT comment.*, user.firstName AS user_firstName, user.lastName AS user_lastName FROM comment
                INNER JOIN user ON comment.id_author = user.id
                WHERE comment.id_post = :post_id";
        $params = [":post_id" => $idPost];
        return $this->findInMultiTable($sql, $params);
    }
}