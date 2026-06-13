<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait JsonTrait
{
    /**
     * Encodes a value to a JSON string, throwing a JsonException on failure.
     *
     * @throws \JsonException
     */
    public static function encode(mixed $value, int $flags = 0): string
    {
        return json_encode($value, $flags | JSON_THROW_ON_ERROR);
    }

    /**
     * Decodes a JSON string, throwing a JsonException on failure.
     *
     * @throws \JsonException
     */
    public static function decode(string $json, bool $associative = true): mixed
    {
        return json_decode($json, $associative, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Determines if a string is valid JSON.
     */
    public static function isValidJson(string $value): bool
    {
        return json_validate($value);
    }
}
