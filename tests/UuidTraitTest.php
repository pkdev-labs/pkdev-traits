<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\UuidTrait;

class UuidTraitTest extends TestCase
{
    use UuidTrait;

    public function testUuid4MatchesRfc4122Format(): void
    {
        $uuid = self::uuid4();
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $uuid
        );
    }

    public function testUuid4IsUnique(): void
    {
        $this->assertNotEquals(self::uuid4(), self::uuid4());
    }

    public function testIsUuidAcceptsAGeneratedUuid(): void
    {
        $this->assertTrue(self::isUuid(self::uuid4()));
    }

    public function testIsUuidAcceptsUppercase(): void
    {
        $this->assertTrue(self::isUuid('550E8400-E29B-41D4-A716-446655440000'));
    }

    public function testIsUuidRejectsInvalidStrings(): void
    {
        $this->assertFalse(self::isUuid('not-a-uuid'));
        $this->assertFalse(self::isUuid(''));
        $this->assertFalse(self::isUuid('550e8400e29b41d4a716446655440000'));
    }
}
