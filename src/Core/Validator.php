<?php

namespace Core;

use Core\Enum\PositionTypes;

class Validator
{
    public static function string(?string $value, int $min = 1, int $max = PHP_INT_MAX): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(?string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function position(?string $value): bool
    {
        $value = trim($value);
        $value = strtolower($value);

        return PositionTypes::tryFrom($value) != null;
    }
}
