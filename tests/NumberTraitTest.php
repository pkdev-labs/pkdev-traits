<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\NumberTrait;

class NumberTraitTest extends TestCase
{
    use NumberTrait;

    /* Format Currency Tests */
    public function testFormatCurrencyDefault()
    {
        $this->assertEquals('$1,234.56', self::formatCurrency(1234.561));
    }

    public function testFormatCurrencyCustomSymbolAndDecimals()
    {
        $this->assertEquals('€1,000', self::formatCurrency(1000, '€', 0));
    }

    /* Percentage Tests */
    public function testPercentageBasic()
    {
        $this->assertEquals(25.0, self::percentage(25, 100));
    }

    public function testPercentageWithRounding()
    {
        $this->assertEquals(33.33, self::percentage(1, 3));
    }

    public function testPercentageZeroTotalReturnsZero()
    {
        $this->assertEquals(0.0, self::percentage(5, 0));
    }

    /* Ordinal Tests */
    public function testOrdinalCommonCases()
    {
        $this->assertEquals('1st', self::ordinal(1));
        $this->assertEquals('2nd', self::ordinal(2));
        $this->assertEquals('3rd', self::ordinal(3));
        $this->assertEquals('4th', self::ordinal(4));
    }

    public function testOrdinalTeenExceptions()
    {
        $this->assertEquals('11th', self::ordinal(11));
        $this->assertEquals('12th', self::ordinal(12));
        $this->assertEquals('13th', self::ordinal(13));
    }

    public function testOrdinalLargeNumber()
    {
        $this->assertEquals('21st', self::ordinal(21));
        $this->assertEquals('112th', self::ordinal(112));
    }

    /* Clamp Tests */
    public function testClampWithinRange()
    {
        $this->assertEquals(5, self::clamp(5, 0, 10));
    }

    public function testClampBelowMin()
    {
        $this->assertEquals(0, self::clamp(-3, 0, 10));
    }

    public function testClampAboveMax()
    {
        $this->assertEquals(10, self::clamp(42, 0, 10));
    }

    /* Human Readable Bytes Tests */
    public function testHumanReadableBytesZero()
    {
        $this->assertEquals('0 B', self::humanReadableBytes(0));
    }

    public function testHumanReadableBytesKilobytes()
    {
        $this->assertEquals('1 KB', self::humanReadableBytes(1024));
    }

    public function testHumanReadableBytesMegabytes()
    {
        $this->assertEquals('1.21 MB', self::humanReadableBytes(1268777));
    }

    /* Abbreviate Tests */
    public function testAbbreviateUnderThousand()
    {
        $this->assertEquals('999', self::abbreviate(999));
    }

    public function testAbbreviateThousands()
    {
        $this->assertEquals('1.2K', self::abbreviate(1200));
    }

    public function testAbbreviateMillions()
    {
        $this->assertEquals('3.5M', self::abbreviate(3500000));
    }

    public function testAbbreviateNegative()
    {
        $this->assertEquals('-1.5K', self::abbreviate(-1500));
    }
}
