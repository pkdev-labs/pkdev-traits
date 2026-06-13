<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait StringTrait
{
    /**
     * Converts a string into a URL-friendly slug.
     */
    public static function slugify(string $value): string
    {
        $value = strtolower(trim($value));
        $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
        return trim($value, '-');
    }

    /**
     * Truncates a string to a maximum length, appending a suffix when cut.
     */
    public static function truncate(string $value, int $length = 100, string $suffix = '...'): string
    {
        if (strlen($value) <= $length) {
            return $value;
        }
        return rtrim(substr($value, 0, $length)) . $suffix;
    }

    /**
     * Limits a string to a number of words, appending a suffix when cut.
     */
    public static function limitWords(string $value, int $words = 10, string $suffix = '...'): string
    {
        $parts = preg_split('/\s+/', trim($value)) ?: [];
        if (count($parts) <= $words) {
            return $value;
        }
        return implode(' ', array_slice($parts, 0, $words)) . $suffix;
    }

    /**
     * Masks all but the last visible characters of a string.
     */
    public static function mask(string $value, int $visible = 4, string $maskChar = '*'): string
    {
        $length = strlen($value);
        if ($visible >= $length) {
            return $value;
        }
        return str_repeat($maskChar, $length - $visible) . substr($value, -$visible);
    }

    /**
     * Converts a string to camelCase.
     */
    public static function toCamelCase(string $value): string
    {
        $value = str_replace(['-', '_'], ' ', $value);
        $value = str_replace(' ', '', ucwords($value));
        return lcfirst($value);
    }

    /**
     * Converts a string to snake_case.
     */
    public static function toSnakeCase(string $value): string
    {
        $value = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $value) ?? $value;
        $value = preg_replace('/[\s\-]+/', '_', $value) ?? $value;
        return strtolower($value);
    }

    /**
     * Converts a string to Title Case.
     */
    public static function toTitleCase(string $value): string
    {
        return ucwords(strtolower($value));
    }

    /**
     * Determines if a string starts with a given substring.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return str_starts_with($haystack, $needle);
    }

    /**
     * Determines if a string ends with a given substring.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        return str_ends_with($haystack, $needle);
    }

    /**
     * Determines if a string contains a given substring.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return str_contains($haystack, $needle);
    }
}
