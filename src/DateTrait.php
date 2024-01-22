<?php

namespace PkDev\Traits;

use DateTime;

trait DateTrait
{
    public static function formatDate($date = null, $format = 'Y-m-d')
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

    public static function addDaysToDate($date, $days, $format = 'Y-m-d')
    {
        $dateObj = new DateTime($date);

        if ($days > 0) {
            $dateObj->modify('+' . $days . ' days');
        } elseif ($days < 0) {
            $dateObj->modify($days . ' days');
        }

        return self::formatDate($dateObj, $format);
    }

    public static function isFutureDate($date)
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate > $currentDate;
    }

    public static function isPastDate($date)
    {
        $currentDate = new DateTime();
        $inputDate = new DateTime($date);
        return $inputDate < $currentDate;
    }

    public static function getDaysDifference($date1, $date2)
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        $interval = $dateObj1->diff($dateObj2);
        return $interval->days;
    }

    public static function areDatesEqual($date1, $date2)
    {
        $dateObj1 = new DateTime($date1);
        $dateObj2 = new DateTime($date2);
        return $dateObj1 == $dateObj2;
    }

    public static function isWeekend($date)
    {
        $dateObj = new DateTime($date);
        $dayOfWeek = $dateObj->format('N');
        return $dayOfWeek >= 6;
    }
}