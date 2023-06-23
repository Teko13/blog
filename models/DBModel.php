<?php

namespace App\models;

use App\models\Model;
use App\src\Application;

abstract class DBModel extends Model
{

    abstract public function tableName(): string;



    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
    public function unique(array $instance)
    {
        $response = $this->findOne($instance);
        return $response === false;
    }

    public function findOne(array $where)
    {
        $tableName = static::tableName();
        $attribut = key($where);
        $query = self::prepare("SELECT * FROM $tableName WHERE $attribut = :value");
        $query->bindValue(':value', $where[$attribut]);
        $query->execute();
        return $query->fetchObject(static::class);
    }
    public function findAll()
    {
        $tableName = $this->tableName();
        $entitys = [];
        $query = $this->prepare("SELECT * FROM $tableName");
        $query->execute();
        while ($entity = $query->fetchObject(static::class)) {
            $entitys[] = $entity;
        }
        return $entitys;
    }
    public function findInMultiTable(string $sql, array $params)
    {
        $query = $this->prepare($sql);
        $query->execute($params);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function save()
    {
        $table = $this->tableName();
        $attributes = $this->attributes();
        $placeholder = array_map(function ($attribute) {
            return ":$attribute";
        }, $attributes);
        $placeholder = implode(',', $placeholder);
        $fields = implode(',', $attributes);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholder)";
        $query = $this->prepare($sql);
        foreach ($attributes as $attribute) {
            $query->bindValue(":$attribute", $this->$attribute);
        }
        return $query->execute();
    }
}