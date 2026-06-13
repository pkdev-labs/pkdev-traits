<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\ArrayTrait;
use stdClass;

class ArrayTraitTest extends TestCase
{
    use ArrayTrait;

    /* Get Tests */
    public function testGetTopLevelKey(): void
    {
        $this->assertEquals('bar', self::get(['foo' => 'bar'], 'foo'));
    }

    public function testGetNestedKeyWithDotNotation(): void
    {
        $array = ['user' => ['profile' => ['name' => 'Phil']]];
        $this->assertEquals('Phil', self::get($array, 'user.profile.name'));
    }

    public function testGetMissingKeyReturnsDefault(): void
    {
        $this->assertEquals('fallback', self::get(['foo' => 'bar'], 'user.name', 'fallback'));
    }

    /* Has Tests */
    public function testHasNestedKey(): void
    {
        $array = ['user' => ['name' => 'Phil']];
        $this->assertTrue(self::has($array, 'user.name'));
    }

    public function testHasTopLevelKey(): void
    {
        $this->assertTrue(self::has(['foo' => 'bar'], 'foo'));
    }

    public function testHasMissingKey(): void
    {
        $this->assertFalse(self::has(['foo' => 'bar'], 'user.name'));
    }

    /* Set Tests */
    public function testSetNestedKeyCreatesStructure(): void
    {
        $result = self::set([], 'user.profile.name', 'Phil');
        $this->assertEquals(['user' => ['profile' => ['name' => 'Phil']]], $result);
    }

    public function testSetOverwritesExistingValue(): void
    {
        $result = self::set(['foo' => 'bar'], 'foo', 'baz');
        $this->assertEquals(['foo' => 'baz'], $result);
    }

    public function testSetMergesIntoExistingNestedArray(): void
    {
        $result = self::set(['user' => ['name' => 'Phil']], 'user.age', 42);
        $this->assertEquals(['user' => ['name' => 'Phil', 'age' => 42]], $result);
    }

    /* Pluck Tests */
    public function testPluckFromArrayRows(): void
    {
        $rows = [['id' => 1, 'name' => 'a'], ['id' => 2, 'name' => 'b']];
        $this->assertEquals([1, 2], self::pluck($rows, 'id'));
    }

    public function testPluckFromObjects(): void
    {
        $a = new stdClass();
        $a->name = 'Phil';
        $b = new stdClass();
        $b->name = 'Casey';
        $this->assertEquals(['Phil', 'Casey'], self::pluck([$a, $b], 'name'));
    }

    /* First / Last Tests */
    public function testFirstReturnsFirstElement(): void
    {
        $this->assertEquals('a', self::first(['a', 'b', 'c']));
    }

    public function testFirstOnEmptyReturnsDefault(): void
    {
        $this->assertEquals('none', self::first([], 'none'));
    }

    public function testLastReturnsLastElement(): void
    {
        $this->assertEquals('c', self::last(['a', 'b', 'c']));
    }

    public function testLastOnEmptyReturnsDefault(): void
    {
        $this->assertEquals('none', self::last([], 'none'));
    }

    /* Flatten Tests */
    public function testFlattenNestedArray(): void
    {
        $array = [1, [2, 3], [[4], 5]];
        $this->assertEquals([1, 2, 3, 4, 5], self::flatten($array));
    }

    /* Only / Except Tests */
    public function testOnlyReturnsSelectedKeys(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $this->assertEquals(['a' => 1, 'c' => 3], self::only($array, ['a', 'c']));
    }

    public function testExceptRemovesGivenKeys(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $this->assertEquals(['b' => 2], self::except($array, ['a', 'c']));
    }

    /* Group By Tests */
    public function testGroupByKey(): void
    {
        $rows = [
            ['role' => 'dev', 'name' => 'Phil'],
            ['role' => 'dev', 'name' => 'Casey'],
            ['role' => 'ops', 'name' => 'Sam'],
        ];
        $result = self::groupBy($rows, 'role');
        $this->assertCount(2, $result['dev']);
        $this->assertCount(1, $result['ops']);
    }

    public function testGroupByObjects(): void
    {
        $a = new stdClass();
        $a->role = 'dev';
        $b = new stdClass();
        $b->role = 'ops';
        $result = self::groupBy([$a, $b], 'role');
        $this->assertCount(1, $result['dev']);
        $this->assertCount(1, $result['ops']);
    }
}
