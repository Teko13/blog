<?php

namespace App\src;

use App\models\Model;

class Field
{

    public Model $model;
    public string $attribute;
    public string $type;
    public string $placeholder;
    public string $value;
    private const TYPE_TEXT = "text";
    private const TYPE_PASSWORD = 'password';
    private const TYPE_EMAIL = 'email';
    private const TYPE_HIDDEN = "hidden";

    public function __construct(Model $model, string $attribute, string $placeholder)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
        $this->placeholder = $placeholder;
        $this->value = "";
    }

    public function __toString()
    {
        return sprintf('
        <input type="%s" name="%s" placeholder="%s" value="%s" required />',
            $this->type, $this->attribute, $this->placeholder, $this->value
        );
    }
    public function typePassword(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function typeEmail(): Field
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
    public function typeHidden(): Field
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }
    public function setValue(string $value): Field
    {
        $this->value = $value;
        return $this;
    }
}
