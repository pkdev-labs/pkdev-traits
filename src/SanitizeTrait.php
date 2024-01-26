<?php

namespace PkDev\Traits;

trait SanitizeTrait
{
    /**
     * Cleans a string
     * @param $value
     * @return string
     */
    public static function sanitizeString($value): string
    {
        $value = trim($value);
        $value = strip_tags($value);
        return (string)$value;
    }

    /**
     * Clean an email
     * @param $email
     * @return string
     */
    public static function sanitizeEmail($email): string
    {
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) ? (string)$sanitizedEmail : '';
    }

    /**
     * Clean an int
     * @param $value
     * @return int
     */
    public static function sanitizeInteger($value): int
    {
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        return (int)$value;
    }

    /**
     * Clean a float
     * @param $value
     * @return float
     */
    public static function sanitizeFloat($value): float
    {
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return (float)$value;
    }

    /**
     * Cleans a url
     * @param $url
     * @return string
     */
    public static function sanitizeURL($url): string
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return filter_var($url, FILTER_VALIDATE_URL) ? (string)$url : '';
    }
}