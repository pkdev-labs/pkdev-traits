<?php

namespace PkDev\Traits;

trait SanitizeTrait
{
    public static function sanitizeString($value)
    {
        $value = trim($value);
        $value = strip_tags($value);
        return (string)$value;
    }

    public static function sanitizeEmail($email)
    {
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) ? (string)$sanitizedEmail : '';
    }

    public static function sanitizeInteger($value)
    {
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        return (int)$value;
    }

    public static function sanitizeFloat($value)
    {
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return (float)$value;
    }

    public static function sanitizeURL($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return filter_var($url, FILTER_VALIDATE_URL) ? (string)$url : '';
    }
}