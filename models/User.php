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
    public string $email;
    public string $password;
    public int $type = self::STATUS_INVALIDE;

    public function attributes(): array
    {
        return ['first_name', 'last_name', 'email', 'password', 'type'];
    }

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
    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULES_UNIQUE, 'is_unique' => $this->unique('user', 'email', $this->email)]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, 'max' => 24]],
        ];
    }
}