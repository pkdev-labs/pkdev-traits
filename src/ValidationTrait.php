<?php

namespace PkDev\Traits;

trait ValidationTrait
{
    public static function validateRequired($value)
    {
        if (is_array($value) || is_object($value)) {
            return !empty($value);
        }

        return isset($value) && !empty(trim($value));
    }

    public static function validateEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validateNumeric($value)
    {
        return is_numeric($value);
    }

    public static function validateInteger($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    public static function validateFloat($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    public static function validateMaxLength($value, $maxLength)
    {
        return strlen($value) <= $maxLength;
    }

    public static function validateMinLength($value, $minLength)
    {
        return strlen($value) >= $minLength;
    }
}