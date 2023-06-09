<?php
namespace App\models;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULES_UNIQUE = 'unique';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $atribute => $rules) {
            $value = $this->{$atribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!(is_string($rule))) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($atribute, self::RULE_REQUIRED, $rule);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($atribute, self::RULE_EMAIL, $rule);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($atribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($atribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULES_UNIQUE && !$rule['is_unique']) {
                    $this->addError($atribute, self::RULES_UNIQUE, $rule);
                }
            }
        }
        return empty($this->errors);
    }
    public function addBasicError(string $attr, string $message)
    {
        $this->errors[$attr] = $message;
    }
    public function addError($attribute, $ruleName, $params)
    {
        $message = $this->errorsMsg()[$ruleName] ?? "";
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute] = $message;
    }
    public function errorsMsg()
    {
        return [
            self::RULE_REQUIRED => "Ce champs est requis",
            self::RULE_EMAIL => "Adresse email incorrect",
            self::RULE_MIN => "Au moins {min} charactères",
            self::RULE_MAX => "Maximum {max} charactères",
            self::RULES_UNIQUE => "Email déjà existant"
        ];
    }
}