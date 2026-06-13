<?php

declare(strict_types=1);

namespace PkDev\Traits;

use DateTime;

trait DateTrait
{
    /**
     * Formats a date (string or DateTime, defaulting to now) using the given format.
     *
     * @throws \Exception
     */
    public static function formatDate(DateTime|string|null $date = null, string $format = 'Y-m-d'): string
    {
        if ($date instanceof DateTime) {
            return $date->format($format);
        } elseif ($date) {
            $date = new DateTime($date);
        } else {
            $date = new DateTime();
        }

        return $date->format($format);
    }

    /**
     * Adds (or subtracts) a number of days to a date.
     *
     * @throws \Exception
     */
    public static function addDaysToDate(string $date, int $days, string $format = 'Y-m-d'): string
    {
        $dateObj = new DateTime($date);

        if ($days > 0) {
            $dateObj->modify('+' . $days . ' days');
        } elseif ($days < 0) {
            $dateObj->modify($days . ' days');
        }

        return self::formatDate($dateObj, $format);
    }

    /**
     * Determines if a date is in the future.
     *
     * @throws \Exception
     */
    public static function isFutureDate(string $date): bool
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate > $currentDate;
    }

    /**
     * Determines if a date is in the past.
     *
     * @throws \Exception
     */
    public static function isPastDate(string $date): bool
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate < $currentDate;
    }

    /**
     * Returns the number of whole days between two dates.
     *
     * @throws \Exception
     */
    public static function getDaysDifference(string $date1, string $date2): int|false
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        $interval = $dateObj1->diff($dateObj2);
        return $interval->days;
    }

    /**
     * Determines if two dates are equal.
     *
     * @throws \Exception
     */
    public static function areDatesEqual(string $date1, string $date2): bool
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        return $dateObj1 == $dateObj2;
    }

    /**
     * Determines if a date falls on a weekend.
     *
     * @throws \Exception
     */
    public static function isWeekend(string $date): bool
    {
        $dateObj = new DateTime($date);
        return (int) $dateObj->format('N') >= 6;
    }
}
