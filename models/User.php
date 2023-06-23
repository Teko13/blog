<?php

namespace App\models;

use App\models\DBModel;

class User extends DBModel
{
    const STATUS_INVALIDE = 0;
    const STATUS_VALIDE = 1;
    const STATUS_ADMIN = 2;

    public string $firstName;
    public string $lastName;
    public int $id;
    public string $email;
    public string $password;
    public int $type = self::STATUS_INVALIDE;


    // public function save(): bool
    // {

    //     $tableName = $this->tableName();
    //     $query = self::prepare("INSERT INTO $tableName (firstName, lastName, email, password, type) VALUES (:first_name, :last_name, :email, :password, :type)");
    //     $values = [
    //         ":first_name" => $this->firstName,
    //         ":last_name" => $this->lastName,
    //         ":email" => $this->email,
    //         ":password" => $this->password,
    //         ':type' => $this->type
    //     ];
    //     $query->execute($values);
    //     return true;
    // }

    public function register()
    {
        $this->type = self::STATUS_INVALIDE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    public function tableName(): string
    {
        return "user";
    }
    public function attributes()
    {
        return ["firstName", "lastName", "email", "password", "type"];
    }
    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULES_UNIQUE, 'is_unique' => $this->unique(['email' => $this->email])]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, 'max' => 24]],
        ];
    }
}