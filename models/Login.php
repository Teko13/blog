<?php

namespace App\models;

use App\models\DBModel;
use App\src\Application;

class Login extends DBModel
{

    public string $email;
    public string $password;

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, 'max' => 24]],
        ];
    }

    public function attributes(): array
    {
        return ['email', 'password'];
    }
    public function tableName(): string
    {
        return "user";
    }

    public function login()
    {

        $user = $this->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addBasicError("Email", "Utilisateur inexistant");
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addBasicError("Email", "Email ou mot de passe incoreecte");
            return false;
        }
        Application::$app->login($user);
        return true;
    }

}