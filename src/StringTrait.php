<?php

namespace PkDev\Traits;

trait StringTrait
{
    /**
     * Converts a string into a URL-friendly slug
     * @param $value
     * @return string
     */
    public static function slugify($value): string
    {
        $value = strtolower(trim((string)$value));
        $value = preg_replace('/[^a-z0-9]+/', '-', $value);
        return trim($value, '-');
    }

    /**
     * Truncates a string to a maximum length, appending a suffix when cut
     * @param $value
     * @param $length
     * @param $suffix
     * @return string
     */
    public static function truncate($value, $length = 100, $suffix = '...'): string
    {
        $value = (string)$value;
        if (strlen($value) <= $length) {
            return $value;
        }
        return rtrim(substr($value, 0, $length)) . $suffix;
    }

    /**
     * Limits a string to a number of words, appending a suffix when cut
     * @param $value
     * @param $words
     * @param $suffix
     * @return string
     */
    public static function limitWords($value, $words = 10, $suffix = '...'): string
    {
        $value = (string)$value;
        $parts = preg_split('/\s+/', trim($value));
        if (count($parts) <= $words) {
            return $value;
        }
        return implode(' ', array_slice($parts, 0, $words)) . $suffix;
    }

    /**
     * Masks all but the last visible characters of a string
     * @param $value
     * @param $visible
     * @param $maskChar
     * @return string
     */
    public static function mask($value, $visible = 4, $maskChar = '*'): string
    {
        $value = (string)$value;
        $length = strlen($value);
        if ($visible >= $length) {
            return $value;
        }
        return str_repeat($maskChar, $length - $visible) . substr($value, -$visible);
    }

    /**
     * Converts a string to camelCase
     * @param $value
     * @return string
     */
    public static function toCamelCase($value): string
    {
        $value = str_replace(['-', '_'], ' ', (string)$value);
        $value = str_replace(' ', '', ucwords($value));
        return lcfirst($value);
    }

    /**
     * Converts a string to snake_case
     * @param $value
     * @return string
     */
    public static function toSnakeCase($value): string
    {
        $value = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', (string)$value);
        $value = preg_replace('/[\s\-]+/', '_', $value);
        return strtolower($value);
    }

    /**
     * Converts a string to Title Case
     * @param $value
     * @return string
     */
    public static function toTitleCase($value): string
    {
        return ucwords(strtolower((string)$value));
    }

    /**
     * Determines if a string starts with a given substring
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle): bool
    {
        return str_starts_with((string)$haystack, (string)$needle);
    }

    /**
     * Determines if a string ends with a given substring
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle): bool
    {
        return str_ends_with((string)$haystack, (string)$needle);
    }

    /**
     * Determines if a string contains a given substring
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function contains($haystack, $needle): bool
    {
        return str_contains((string)$haystack, (string)$needle);
    }
}
