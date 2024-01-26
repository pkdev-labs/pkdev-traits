<?php

namespace PkDev\Traits;

trait ValidationTrait
{
    /**
     * Validates if required and present
     * @param $value
     * @return bool
     */
    public static function validateRequired($value): bool
    {
        if (is_array($value) || is_object($value)) {
            return !empty($value);
        }

        return isset($value) && !empty(trim($value));
    }

    /**
     * Validates email address
     * @param $value
     * @return bool
     */
    public static function validateEmail($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates if numeric
     * @param $value
     * @return bool
     */
    public static function validateNumeric($value): bool
    {
        return is_numeric($value);
    }

    /**
     * Validates if integer
     * @param $value
     * @return bool
     */
    public static function validateInteger($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    /**
     * Validates if float
     * @param $value
     * @return bool
     */
    public static function validateFloat($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    /**
     * Validates if less than max length
     * @param $value
     * @param $maxLength
     * @return bool
     */
    public static function validateMaxLength($value, $maxLength): bool
    {
        return strlen($value) <= $maxLength;
    }

    /**
     * Validates if more than min length
     * @param $value
     * @param $minLength
     * @return bool
     */
    public static function validateMinLength($value, $minLength): bool
    {
        return strlen($value) >= $minLength;
    }
}