<?php

namespace App\src;

use App\src\Field;
use App\models\Model;

class Form
{

    public static function startTag(string $action, string $method): Form
    {
        echo "<form action='$action' method='$method'>";
        return new Form();
    }

    public static function endTag(): void
    {
        echo "</form>";
    }

    public static function field(Model $model, string $attribute, string $placeholder): Field
    {
        return new Field($model, $attribute, $placeholder);
    }
}
