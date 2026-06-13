<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait HashTrait
{
    /**
     * Hashes a password using PHP's default (and self-updating) algorithm.
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifies a plaintext password against a stored hash.
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Generates a keyed HMAC of the given data.
     */
    public static function hmac(string $data, string $key, string $algorithm = 'sha256'): string
    {
        return hash_hmac($algorithm, $data, $key);
    }
}
