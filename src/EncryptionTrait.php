<?php

namespace PkDev\Traits;

trait EncryptionTrait
{
    protected static string $defaultAlgorithm = 'aes-256-cbc';

    public static function getEncryptionKey()
    {
        if (isset($_SESSION['encryption_key'])) {
            return $_SESSION['encryption_key'];
        } else {
            $key = self::generateEncryptionKey();
            $_SESSION['encryption_key'] = $key;
            return $key;
        }
    }

    public static function generateEncryptionKey(int $length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    public static function encryptData($data, $key, $algorithm = null)
    {
        $algorithm ??= self::$defaultAlgorithm;
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($algorithm));
        $encryptedData = openssl_encrypt($data, $algorithm, $key, 0, $iv);
        return base64_encode($iv . $encryptedData);
    }

    public static function decryptData($encryptedData, $key, $algorithm = null)
    {
        $algorithm ??= self::$defaultAlgorithm;
        $encryptedData = base64_decode($encryptedData);
        $iv = substr($encryptedData, 0, openssl_cipher_iv_length($algorithm));
        $data = openssl_decrypt(substr($encryptedData, openssl_cipher_iv_length($algorithm)), $algorithm, $key, 0, $iv);
        return $data;
    }
}