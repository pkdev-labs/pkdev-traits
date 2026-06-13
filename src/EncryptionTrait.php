<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait EncryptionTrait
{
    protected static string $defaultAlgorithm = 'aes-256-cbc';

    /**
     * Returns the session encryption key, generating and storing one if absent.
     */
    public static function getEncryptionKey(): string
    {
        $key = $_SESSION['encryption_key'] ?? null;
        if (is_string($key)) {
            return $key;
        }

        $key = self::generateEncryptionKey();
        $_SESSION['encryption_key'] = $key;
        return $key;
    }

    /**
     * Generates a random hex encryption key.
     *
     * @param positive-int $length
     */
    public static function generateEncryptionKey(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Encrypts data and returns a base64-encoded payload (IV prepended).
     */
    public static function encryptData(string $data, string $key, ?string $algorithm = null): string
    {
        $algorithm ??= self::$defaultAlgorithm;
        $ivLength = @openssl_cipher_iv_length($algorithm);
        if ($ivLength === false) {
            throw new \InvalidArgumentException("Unknown cipher algorithm: {$algorithm}");
        }

        $iv = openssl_random_pseudo_bytes($ivLength);
        $encryptedData = openssl_encrypt($data, $algorithm, $key, 0, $iv);
        return base64_encode($iv . $encryptedData);
    }

    /**
     * Decrypts a base64-encoded payload produced by encryptData().
     */
    public static function decryptData(string $encryptedData, string $key, ?string $algorithm = null): string|false
    {
        $algorithm ??= self::$defaultAlgorithm;
        $ivLength = @openssl_cipher_iv_length($algorithm);
        if ($ivLength === false) {
            throw new \InvalidArgumentException("Unknown cipher algorithm: {$algorithm}");
        }

        $decoded = base64_decode($encryptedData);
        $iv = substr($decoded, 0, $ivLength);
        return openssl_decrypt(substr($decoded, $ivLength), $algorithm, $key, 0, $iv);
    }
}
