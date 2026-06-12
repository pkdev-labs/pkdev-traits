<?php

namespace PkDev\Traits;

trait ArrayTrait
{
    /**
     * Retrieves a value from a nested array using dot notation
     * @param array $array
     * @param string $key
     * @param $default
     * @return mixed
     */
    public static function get(array $array, string $key, $default = null): mixed
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    /**
     * Determines if a nested key exists using dot notation
     * @param array $array
     * @param string $key
     * @return bool
     */
    public static function has(array $array, string $key): bool
    {
        if (array_key_exists($key, $array)) {
            return true;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Sets a value in a nested array using dot notation and returns the result
     * @param array $array
     * @param string $key
     * @param $value
     * @return array
     */
    public static function set(array $array, string $key, $value): array
    {
        $segments = explode('.', $key);
        $ref = &$array;

        foreach ($segments as $i => $segment) {
            if ($i === count($segments) - 1) {
                $ref[$segment] = $value;
            } else {
                if (!isset($ref[$segment]) || !is_array($ref[$segment])) {
                    $ref[$segment] = [];
                }
                $ref = &$ref[$segment];
            }
        }
        unset($ref);

        return $array;
    }

    /**
     * Extracts a single column of values from an array of rows
     * @param array $array
     * @param string $key
     * @return array
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
     * Returns the first element of an array, or a default when empty
     * @param array $array
     * @param $default
     * @return mixed
     */
    public static function first(array $array, $default = null): mixed
    {
        foreach ($array as $item) {
            return $item;
        }

        return $default;
    }

    /**
     * Returns the last element of an array, or a default when empty
     * @param array $array
     * @param $default
     * @return mixed
     */
    public static function last(array $array, $default = null): mixed
    {
        if (empty($array)) {
            return $default;
        }

        return end($array);
    }

    /**
     * Flattens a multi-dimensional array into a single dimension of values
     * @param array $array
     * @return array
     */
    public static function flatten(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($item) use (&$result) {
            $result[] = $item;
        });

        return $result;
    }

    /**
     * Returns only the given keys from an array
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Returns the array without the given keys
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }

    /**
     * Groups an array of rows by the value of a given key
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function groupBy(array $array, string $key): array
    {
        $result = [];
        foreach ($array as $item) {
            $groupKey = is_array($item) ? ($item[$key] ?? null) : ($item->$key ?? null);
            $result[$groupKey][] = $item;
        }

        return $result;
    }
}
