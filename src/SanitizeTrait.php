<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait SanitizeTrait
{
    /**
     * Trims a string and strips any HTML tags.
     */
    public static function sanitizeString(mixed $value): string
    {
        return strip_tags(trim(is_scalar($value) ? (string) $value : ''));
    }

    /**
     * Sanitizes an email address, returning an empty string when invalid.
     */
    public static function sanitizeEmail(mixed $email): string
    {
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) ? (string) $sanitizedEmail : '';
    }

    /**
     * Sanitizes a value down to an integer.
     */
    public static function sanitizeInteger(mixed $value): int
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Sanitizes a value down to a float.
     */
    public static function sanitizeFloat(mixed $value): float
    {
        return (float) filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * Sanitizes a URL, returning an empty string when invalid.
     */
    public static function sanitizeURL(mixed $url): string
    {
        $sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);
        return filter_var($sanitizedUrl, FILTER_VALIDATE_URL) ? (string) $sanitizedUrl : '';
    }
}
