<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\HashTrait;

class HashTraitTest extends TestCase
{
    use HashTrait;

    public function testHashPasswordIsVerifiable(): void
    {
        $hash = self::hashPassword('correct horse battery staple');
        $this->assertTrue(self::verifyPassword('correct horse battery staple', $hash));
    }

    public function testHashPasswordIsSaltedPerCall(): void
    {
        $this->assertNotEquals(
            self::hashPassword('same-password'),
            self::hashPassword('same-password')
        );
    }

    public function testVerifyPasswordRejectsWrongPassword(): void
    {
        $hash = self::hashPassword('right');
        $this->assertFalse(self::verifyPassword('wrong', $hash));
    }

    public function testHmacIsDeterministic(): void
    {
        $this->assertEquals(
            self::hmac('payload', 'secret'),
            self::hmac('payload', 'secret')
        );
    }

    public function testHmacMatchesNativeHashHmac(): void
    {
        $this->assertEquals(
            hash_hmac('sha256', 'payload', 'secret'),
            self::hmac('payload', 'secret')
        );
    }

    public function testHmacRespectsAlgorithm(): void
    {
        $this->assertEquals(
            hash_hmac('sha512', 'payload', 'secret'),
            self::hmac('payload', 'secret', 'sha512')
        );
    }
}
