<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait ValidationTrait
{
    /**
     * Validates that a value is present and not empty.
     */
    public static function validateRequired(mixed $value): bool
    {
        if (is_array($value) || is_object($value)) {
            return !empty($value);
        }

        return is_scalar($value) && !empty(trim((string) $value));
    }

    /**
     * Validates an email address.
     */
    public static function validateEmail(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates that a value is numeric.
     */
    public static function validateNumeric(mixed $value): bool
    {
        return is_numeric($value);
    }

    /**
     * Validates that a value is an integer.
     */
    public static function validateInteger(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    /**
     * Validates that a value is a float.
     */
    public static function validateFloat(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    /**
     * Validates that a value does not exceed a maximum length.
     */
    public static function validateMaxLength(string|int|float|null $value, int $maxLength): bool
    {
        return strlen((string) $value) <= $maxLength;
    }

    /**
     * Validates that a value meets a minimum length.
     */
    public static function validateMinLength(string|int|float|null $value, int $minLength): bool
    {
        return strlen((string) $value) >= $minLength;
    }
}
