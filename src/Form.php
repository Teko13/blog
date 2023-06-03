<?php

namespace App\src;

use App\src\Field;

class Form
{

    public static function startTag($action, $method)
    {
        echo "<form action='$action' method='$method'>";
        return new Form();
    }

    public static function endTag()
    {
        echo "</form>";
    }

    public static function field($model, $attribute, $placeholder)
    {
        return new Field($model, $attribute, $placeholder);
    }
}