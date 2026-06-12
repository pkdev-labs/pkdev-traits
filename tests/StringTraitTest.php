<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\StringTrait;

class StringTraitTest extends TestCase
{
    use StringTrait;

    /* Slugify Tests */
    public function testSlugifyBasicString()
    {
        $this->assertEquals('hello-world', self::slugify('Hello World'));
    }

    public function testSlugifyStripsSpecialCharacters()
    {
        $this->assertEquals('foo-bar-baz', self::slugify('  Foo & Bar / Baz!  '));
    }

    public function testSlugifyAlreadySlug()
    {
        $this->assertEquals('already-a-slug', self::slugify('already-a-slug'));
    }

    /* Truncate Tests */
    public function testTruncateLongString()
    {
        $this->assertEquals('Hello...', self::truncate('Hello World', 5));
    }

    public function testTruncateShortStringUnchanged()
    {
        $this->assertEquals('Hello', self::truncate('Hello', 10));
    }

    public function testTruncateCustomSuffix()
    {
        $this->assertEquals('Hello[more]', self::truncate('Hello World', 5, '[more]'));
    }

    /* Limit Words Tests */
    public function testLimitWordsTruncates()
    {
        $this->assertEquals('one two three...', self::limitWords('one two three four five', 3));
    }

    public function testLimitWordsUnderLimitUnchanged()
    {
        $this->assertEquals('one two', self::limitWords('one two', 5));
    }

    /* Mask Tests */
    public function testMaskHidesLeadingCharacters()
    {
        $this->assertEquals('************1111', self::mask('4111111111111111', 4));
    }

    public function testMaskShorterThanVisibleUnchanged()
    {
        $this->assertEquals('abc', self::mask('abc', 4));
    }

    public function testMaskCustomCharacter()
    {
        $this->assertEquals('xxxWorld', self::mask('HelWorld', 5, 'x'));
    }

    /* Case Conversion Tests */
    public function testToCamelCaseFromSnake()
    {
        $this->assertEquals('fooBarBaz', self::toCamelCase('foo_bar_baz'));
    }

    public function testToCamelCaseFromKebabAndSpaces()
    {
        $this->assertEquals('fooBarBaz', self::toCamelCase('foo-bar baz'));
    }

    public function testToSnakeCaseFromCamel()
    {
        $this->assertEquals('foo_bar_baz', self::toSnakeCase('fooBarBaz'));
    }

    public function testToSnakeCaseFromSpacesAndKebab()
    {
        $this->assertEquals('foo_bar_baz', self::toSnakeCase('foo bar-baz'));
    }

    public function testToTitleCase()
    {
        $this->assertEquals('Hello World', self::toTitleCase('hELLO wORLD'));
    }

    /* Substring Predicate Tests */
    public function testStartsWith()
    {
        $this->assertTrue(self::startsWith('foobar', 'foo'));
        $this->assertFalse(self::startsWith('foobar', 'bar'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(self::endsWith('foobar', 'bar'));
        $this->assertFalse(self::endsWith('foobar', 'foo'));
    }

    public function testContains()
    {
        $this->assertTrue(self::contains('foobar', 'oob'));
        $this->assertFalse(self::contains('foobar', 'xyz'));
    }
}
