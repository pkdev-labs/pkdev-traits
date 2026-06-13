<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\JsonTrait;

class JsonTraitTest extends TestCase
{
    use JsonTrait;

    public function testEncodeProducesJson(): void
    {
        $this->assertEquals('{"a":1,"b":"two"}', self::encode(['a' => 1, 'b' => 'two']));
    }

    public function testEncodeHonorsFlags(): void
    {
        $this->assertEquals("[\n    1\n]", self::encode([1], JSON_PRETTY_PRINT));
    }

    public function testEncodeThrowsOnInvalidValue(): void
    {
        $this->expectException(\JsonException::class);
        self::encode(NAN);
    }

    public function testDecodeToAssociativeArray(): void
    {
        $this->assertEquals(['a' => 1, 'b' => 'two'], self::decode('{"a":1,"b":"two"}'));
    }

    public function testDecodeToObject(): void
    {
        $this->assertEquals((object) ['a' => 1], self::decode('{"a":1}', false));
    }

    public function testDecodeThrowsOnInvalidJson(): void
    {
        $this->expectException(\JsonException::class);
        self::decode('{not valid}');
    }

    public function testIsValidJson(): void
    {
        $this->assertTrue(self::isValidJson('{"a":1}'));
        $this->assertFalse(self::isValidJson('{not valid}'));
    }
}
