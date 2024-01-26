<?php

namespace PkDev\Traits;

use DateTime;

trait DateTrait
{
    /**
     * @param $date
     * @param $format
     * @return string
     * @throws \Exception
     */
    public static function formatDate($date = null, $format = 'Y-m-d'): string
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
     * @param $date
     * @param $days
     * @param $format
     * @return string
     * @throws \Exception
     */
    public static function addDaysToDate($date, $days, $format = 'Y-m-d'): string
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
     * @param $date
     * @return bool
     * @throws \Exception
     */
    public static function isFutureDate($date): bool
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate > $currentDate;
    }

    /**
     * @param $date
     * @return bool
     * @throws \Exception
     */
    public static function isPastDate($date): bool
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate < $currentDate;
    }

    /**
     * @param $date1
     * @param $date2
     * @return false|int
     * @throws \Exception
     */
    public static function getDaysDifference($date1, $date2): int|false
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        $interval = $dateObj1->diff($dateObj2);
        return $interval->days;
    }

    /**
     * @param $date1
     * @param $date2
     * @return bool
     * @throws \Exception
     */
    public static function areDatesEqual($date1, $date2): bool
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        return $dateObj1 == $dateObj2;
    }

    /**
     * @param $date
     * @return bool
     * @throws \Exception
     */
    public static function isWeekend($date): bool
    {
        $dateObj = new DateTime($date);
        $dayOfWeek = $dateObj->format('N');
        return $dayOfWeek >= 6;
    }
}