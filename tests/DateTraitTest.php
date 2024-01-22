<?php

namespace PkDev\Traits\Tests;

use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;
use PkDev\Traits\DateTrait;

class DateTraitTest extends TestCase
{
    use DateTrait;
    
    private $trait;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->trait = new class {
            use DateTrait;
        };
    }

    /* Format Date Tests */
    public function testFormatDateWithSpecificDate(): void
    {
        $result = self::formatDate('2020-01-01', 'Y-m-d');
        $this->assertEquals('2020-01-01', $result);
    }

    public function testFormatDateWithDefaultFormat()
    {
        $result = self::formatDate('2022-01-01');
        $this->assertEquals('2022-01-01', $result);
    }

    public function testFormatCurrentDate()
    {
        $result = self::formatDate();
        $today = (new DateTime())->format('Y-m-d');
        $this->assertEquals($today, $result);
    }

    public function testFormatDateWithDifferentFormat()
    {
        $result = self::formatDate('2022-01-01', 'F j, Y');
        $this->assertEquals('January 1, 2022', $result);
    }

    public function testFormatDateWithNullDate()
    {
        $result = self::formatDate(null, 'Y-m-d');
        $today = (new DateTime())->format('Y-m-d');
        $this->assertEquals($today, $result);
    }

    public function testFormatDateWithInvalidDate()
    {
        $this->expectException(\Exception::class);
        self::formatDate('invalid-date');
    }
    
    /* Add Days Tests */
    public function testAddDaysToDateWithDefaultFormat()
    {
        $result = self::addDaysToDate('2022-01-01', 5);
        $this->assertEquals('2022-01-06', $result);
    }

    public function testAddDaysToDateWithCustomFormat()
    {
        $result = self::addDaysToDate('2022-01-01', 5, 'F j, Y');
        $this->assertEquals('January 6, 2022', $result);
    }

    public function testAddDaysToDateWithNegativeDays()
    {
        $result = self::addDaysToDate('2022-01-01', -5);
        $this->assertEquals('2021-12-27', $result);
    }

    public function testAddDaysToDateWithZeroDays()
    {
        $result = self::addDaysToDate('2022-01-01', 0);
        $this->assertEquals('2022-01-01', $result);
    }
    
    /* Is Future Date Tests */
    public function testIsFutureDateWithFutureDate()
    {
        $futureDate = (new DateTime())->add(new DateInterval('P3W'))->format('Y-m-d');
        $result = self::isFutureDate($futureDate);
        $this->assertTrue($result);
    }

    public function testIsFutureDateWithPastDate()
    {
        $result = self::isFutureDate('2020-01-01');
        $this->assertFalse($result);
    }

    public function testIsFutureDateWithCurrentDate()
    {
        $currentDate = (new DateTime())->format('Y-m-d');
        $result = self::isFutureDate($currentDate);
        $this->assertFalse($result);
    }

    /* Is Past Date Tests */
    public function testIsPastDateWithPastDate()
    {
        $result = self::isPastDate('2020-01-01');
        $this->assertTrue($result);
    }

    public function testIsPastDateWithFutureDate()
    {
        // Calculate a future date, for example, three weeks from today
        $futureDate = (new DateTime())->add(new DateInterval('P3W'))->format('Y-m-d');

        $result = self::isPastDate($futureDate);
        $this->assertFalse($result);
    }

    /* Get Days Different Tests */
    public function testGetDaysDifferenceWithDifferentDates()
    {
        $date1 = '2023-01-01';
        $date2 = '2023-01-05';

        $result = self::getDaysDifference($date1, $date2);
        $this->assertEquals(4, $result);
    }

    public function testGetDaysDifferenceWithSameDates()
    {
        $date1 = '2022-01-01';
        $date2 = '2022-01-01';

        $result = self::getDaysDifference($date1, $date2);
        $this->assertEquals(0, $result);
    }

    /* Are Days Equal Tests */
    public function testAreDatesEqualWithEqualDates()
    {
        $date1 = '2022-01-01';
        $date2 = '2022-01-01';

        $result = self::areDatesEqual($date1, $date2);
        $this->assertTrue($result);
    }

    public function testAreDatesEqualWithDifferentDates()
    {
        $date1 = '2022-01-01';
        $date2 = '2022-01-02';

        $result = self::areDatesEqual($date1, $date2);
        $this->assertFalse($result);
    }

    /* Is Weekend Tests */
    public function testIsWeekendWithWeekendDate()
    {
        $weekendDate = '2024-01-20'; // Saturday 1/20/2024 (day of the week 6)
        $result = self::isWeekend($weekendDate);
        $this->assertTrue($result);
    }

    public function testIsWeekendWithWeekdayDate()
    {
        $weekdayDate = '2024-01-22'; // Monday 1/22/2024 (day of the week 1)
        $result = self::isWeekend($weekdayDate);
        $this->assertFalse($result);
    }
}