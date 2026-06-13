<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\EncryptionTrait;

class EncryptionTraitTest extends TestCase
{
    use EncryptionTrait;

    public function testGenerateEncryptionKey(): void
    {
        $encryptionKey = self::generateEncryptionKey();
        $this->assertMatchesRegularExpression('/^[a-f0-9]{64}$/', $encryptionKey);
    }

    public function testEncryptAndDecryptData(): void
    {
        $dataToEncrypt = 'Hello, this is some sensitive data!';
        $encryptionKey = self::generateEncryptionKey();

        $encryptedData = self::encryptData($dataToEncrypt, $encryptionKey, 'aes-256-cbc');
        $decryptedData = self::decryptData($encryptedData, $encryptionKey, 'aes-256-cbc');

        $this->assertEquals($dataToEncrypt, $decryptedData);
    }

    public function testGetEncryptionKeyWithExistingSession(): void
    {
        $_SESSION['encryption_key'] = 'existing_key';
        $key = $this->getEncryptionKey();
        $this->assertEquals('existing_key', $key);
    }

    public function testGetEncryptionKeyWithoutExistingSession(): void
    {
        // Simulate no existing session
        unset($_SESSION['encryption_key']);
        $encryptionKey = self::getEncryptionKey();
        $this->assertMatchesRegularExpression('/^[a-f0-9]{64}$/', $encryptionKey);
    }

    public function testEncryptDataWithUnknownAlgorithmThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        self::encryptData('secret', 'key', 'not-a-real-cipher');
    }

    public function testDecryptDataWithUnknownAlgorithmThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        self::decryptData('payload', 'key', 'not-a-real-cipher');
    }
}
