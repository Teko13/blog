<?php

namespace App\models;

use App\models\Model;
use App\src\Application;

abstract class DBModel extends Model
{

    abstract public function tableName(): string;
    abstract public function attributes(): array;

    public function save()
    {

        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $query = self::prepare("INSERT INTO $tableName (firstName, lastName, email, password, type) VALUES (:first_name, :last_name, :email, :password, :type)");
        $values = [
            ":first_name" => $this->firstName,
            ":last_name" => $this->lastName,
            ":email" => $this->email,
            ":password" => $this->password,
            ':type' => $this->type
        ];
        $query->execute($values);
        return true;
    }


    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
    public function unique($tableName, $column, $value)
    {
        $query = self::prepare("SELECT * FROM $tableName WHERE $column = :attr");
        $query->bindValue(':attr', $value);
        $query->execute();
        $response = $query->fetch();
        return $response === false;
    }

    public function findOne(array $where)
    {
        $tableName = static::tableName();
        $attribut = key($where);
        $query = self::prepare("SELECT * FROM $tableName WHERE $attribut = :value");
        $query->bindValue(':value', $where[$attribut]);
        $query->execute();
        return $query->fetchObject(User::class);
    }
}