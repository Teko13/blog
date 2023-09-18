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
    public function update(array $condition): bool
    {
        $whereAttribute = key($condition);
        $whereValue = $condition[$whereAttribute];
        $table = $this->tableName();
        $attributes = $this->attributes();
        $item = array_map(function ($attribute) {
            if (isset($this->$attribute)) {
                return "$attribute=:$attribute";
            }
        }, $attributes);
        $item = array_filter($item, null);
        $item = implode(',', $item);
        $sql = "UPDATE $table SET $item WHERE $whereAttribute = $whereValue";
        $query = $this->prepare($sql);
        foreach ($attributes as $attribute) {
            try {
                $query->bindValue(":$attribute", $this->$attribute);
            } catch (\Throwable $th) {
                continue;
            }
        }
        return $query->execute();
    }
    public function delete(array $condition): bool
    {
        $whereAttribute = key($condition);
        $whereValue = $condition[$whereAttribute];
        $tableName = $this->tableName();
        $sql = "DELETE FROM $tableName WHERE $whereAttribute = $whereValue";
        $query = $this->prepare($sql);
        return $query->execute();
    }
    public function findMany(array $where)
    {
        $tableName = static::tableName();
        $attribut = key($where);
        $query = self::prepare("SELECT * FROM $tableName WHERE $attribut = :value");
        $query->bindValue(':value', $where[$attribut]);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
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
    public function findInMultiTable(string $sql, array $params = [])
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
        // We need to filter the array $attributes to remove the uninitialized attributes for avoid errors during the SQL query.
        $attributes = array_filter($attributes, function ($attribute) {
            return isset($this->$attribute);
        });
        $placeholder = array_map(function ($attribute) {
            if (isset($this->$attribute)) {
                return ":$attribute";
            }
        }, $attributes);
        $placeholder = array_filter($placeholder, null);
        $placeholder = implode(',', $placeholder);
        $fields = implode(',', $attributes);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholder)";
        $query = $this->prepare($sql);
        foreach ($attributes as $attribute) {
            try {
                $query->bindValue(":$attribute", $this->$attribute);
            } catch (\Throwable $th) {
                continue;
            }
        }
        return $query->execute();
    }
}
