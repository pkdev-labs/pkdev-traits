<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\SanitizeTrait;

class SanitizeTraitTest extends TestCase
{
    use SanitizeTrait;

    /* Sanitize string Tests */
    public function testSanitizeStringRemovesWhitespace()
    {
        $input = "  Hello World  ";
        $result = self::sanitizeString($input);
        $this->assertEquals("Hello World", $result);
    }

    public function testSanitizeStringRemovesHTMLTags()
    {
        $input = "<p>Test <b>string</b></p>";
        $result = self::sanitizeString($input);
        $this->assertEquals("Test string", $result);
    }

    /* Sanitize Email Tests */
    public function testSanitizeValidEmail()
    {
        $input = 'user@example.com';
        $result = self::sanitizeEmail($input);
        $this->assertEquals('user@example.com', $result);
    }

    public function testSanitizeInvalidEmail()
    {
        $input = 'invalid-email';
        $result = self::sanitizeEmail($input);
        $this->assertEquals('', $result);
    }

    public function testSanitizeEmptyEmail()
    {
        $input = '';
        $result = self::sanitizeEmail($input);
        $this->assertEquals('', $result);
    }

    /* Sanitize Integer Tests */
    public function testSanitizeValidInteger()
    {
        $input = '123';
        $result = self::sanitizeInteger($input);
        $this->assertEquals(123, $result);
    }

    public function testSanitizeInvalidInteger()
    {
        $input = 'abc123';
        $result = self::sanitizeInteger($input);
        $this->assertEquals(123, $result);
    }

    public function testSanitizeEmptyInteger()
    {
        $input = '';
        $result = self::sanitizeInteger($input);
        $this->assertEquals(0, $result);
    }

    /* Sanitize Float Tests */
    public function testSanitizeValidFloat()
    {
        $input = '123.45';
        $result = self::sanitizeFloat($input);
        $this->assertEquals(123.45, $result);
    }

    public function testSanitizeInvalidFloat()
    {
        $input = 'abc123.45';
        $result = self::sanitizeFloat($input);
        $this->assertEquals(123.45, $result);
    }

    public function testSanitizeEmptyFloat()
    {
        $input = '';
        $result = self::sanitizeFloat($input);
        $this->assertEquals(0.0, $result);
    }

    /* Sanitize URL Tests */
    public function testSanitizeValidURL()
    {
        $input = 'https://example.com';
        $result = self::sanitizeURL($input);
        $this->assertEquals('https://example.com', $result);
    }

    public function testSanitizeInvalidURL()
    {
        $input = 'invalid-url';
        $result = self::sanitizeURL($input);
        $this->assertEquals('', $result); // Returns an empty string for invalid URL
    }

    public function testSanitizeEmptyURL()
    {
        $input = '';
        $result = self::sanitizeURL($input);
        $this->assertEquals('', $result); // Returns an empty string for empty input
    }
}