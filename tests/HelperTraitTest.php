<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\HelperTrait;

class HelperTraitTest extends TestCase
{
    use HelperTrait;

    public function testGenerateRandomStringDefaultLength()
    {
        $randomString = self::generateRandomString();
        $this->assertEquals(10, strlen($randomString));
    }

    public function testGenerateRandomStringCustomLength()
    {
        $length = 15;
        $randomString = self::generateRandomString($length);
        $this->assertEquals($length, strlen($randomString));
    }

    public function testGenerateRandomStringContainsValidCharacters()
    {
        $randomString = self::generateRandomString(20);
        $validCharacters = array_merge(range('a', 'z'), range('A', 'Z'), array_map('strval', range(0, 9)));

        for ($i = 0; $i < strlen($randomString); $i++) {
            $this->assertContains($randomString[$i], $validCharacters);
        }
    }

    public function testGenerateRandomStringDoesNotExceedValidCharacters()
    {
        $length = 100;
        $randomString = self::generateRandomString($length);
        $validCharacters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));

        $invalidCharacters = str_replace($validCharacters, '', $randomString);
        $this->assertEmpty($invalidCharacters, 'Random string contains invalid characters.');
    }
}