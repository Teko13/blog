<?php

namespace App\src;

use App\src\Field;

class Form
{

    public static function startTag($action, $method): Form
    {
        echo "<form action='$action' method='$method'>";
        return new Form();
    }

    public static function endTag(): void
    {
        echo "</form>";
    }

    public static function field($model, $attribute, $placeholder): Field
    {
        return new Field($model, $attribute, $placeholder);
    }
}