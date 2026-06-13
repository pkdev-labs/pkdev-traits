<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait ArrayTrait
{
    /**
     * Retrieves a value from a nested array using dot notation.
     *
     * @param array<array-key, mixed> $array
     */
    public static function get(array $array, string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        $value = $array;
        foreach (explode('.', $key) as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }

        return $value;
    }

    /**
     * Determines if a nested key exists using dot notation.
     *
     * @param array<array-key, mixed> $array
     */
    public static function has(array $array, string $key): bool
    {
        if (array_key_exists($key, $array)) {
            return true;
        }

        $value = $array;
        foreach (explode('.', $key) as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Sets a value in a nested array using dot notation and returns the result.
     *
     * @param array<array-key, mixed> $array
     * @return array<array-key, mixed>
     */
    public static function set(array $array, string $key, mixed $value): array
    {
        $segments = explode('.', $key);
        $segment = array_shift($segments);

        if ($segments === []) {
            $array[$segment] = $value;
            return $array;
        }

        $child = isset($array[$segment]) && is_array($array[$segment]) ? $array[$segment] : [];
        $array[$segment] = self::set($child, implode('.', $segments), $value);
        return $array;
    }

    /**
     * Extracts a single column of values from an array of rows.
     *
     * @param array<array-key, mixed> $array
     * @return list<mixed>
     */
    public static function pluck(array $array, string $key): array
    {
        $results = [];
        foreach ($array as $item) {
            if (is_array($item) && array_key_exists($key, $item)) {
                $results[] = $item[$key];
            } elseif (is_object($item) && isset($item->$key)) {
                $results[] = $item->$key;
            }
        }

        return $results;
    }

    /**
     * Returns the first element of an array, or a default when empty.
     *
     * @param array<array-key, mixed> $array
     */
    public static function first(array $array, mixed $default = null): mixed
    {
        foreach ($array as $item) {
            return $item;
        }

        return $default;
    }

    /**
     * Returns the last element of an array, or a default when empty.
     *
     * @param array<array-key, mixed> $array
     */
    public static function last(array $array, mixed $default = null): mixed
    {
        if (empty($array)) {
            return $default;
        }

        return end($array);
    }

    /**
     * Flattens a multi-dimensional array into a single dimension of values.
     *
     * @param array<array-key, mixed> $array
     * @return list<mixed>
     */
    public static function flatten(array $array): array
    {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result = array_merge($result, self::flatten($item));
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * Returns only the given keys from an array.
     *
     * @param array<array-key, mixed> $array
     * @param list<array-key> $keys
     * @return array<array-key, mixed>
     */
    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Returns the array without the given keys.
     *
     * @param array<array-key, mixed> $array
     * @param list<array-key> $keys
     * @return array<array-key, mixed>
     */
    public static function except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }

    /**
     * Groups an array of rows by the value of a given key.
     *
     * @param array<array-key, mixed> $array
     * @return array<array-key, list<mixed>>
     */
    public static function groupBy(array $array, string $key): array
    {
        $result = [];
        foreach ($array as $item) {
            $raw = is_array($item) ? ($item[$key] ?? null) : (is_object($item) ? ($item->$key ?? null) : null);
            $groupKey = (is_int($raw) || is_string($raw)) ? $raw : (string) (is_scalar($raw) ? $raw : '');
            $result[$groupKey][] = $item;
        }

        return $result;
    }
}
