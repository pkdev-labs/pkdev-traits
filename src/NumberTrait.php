<?php

declare(strict_types=1);

namespace PkDev\Traits;

trait NumberTrait
{
    /**
     * Formats a number as currency.
     */
    public static function formatCurrency(int|float $value, string $symbol = '$', int $decimals = 2): string
    {
        return $symbol . number_format((float) $value, $decimals);
    }

    /**
     * Calculates what percentage a part is of a total.
     */
    public static function percentage(int|float $part, int|float $total, int $decimals = 2): float
    {
        if ((float) $total === 0.0) {
            return 0.0;
        }

        return round(($part / $total) * 100, $decimals);
    }

    /**
     * Returns a number with its ordinal suffix (1st, 2nd, 3rd, ...).
     */
    public static function ordinal(int $number): string
    {
        $abs = abs($number);

        if (($abs % 100) >= 11 && ($abs % 100) <= 13) {
            $suffix = 'th';
        } else {
            $suffix = match ($abs % 10) {
                1 => 'st',
                2 => 'nd',
                3 => 'rd',
                default => 'th',
            };
        }

        return $number . $suffix;
    }

    /**
     * Constrains a number to lie between a minimum and maximum.
     */
    public static function clamp(int|float $value, int|float $min, int|float $max): int|float
    {
        return max($min, min($max, $value));
    }

    /**
     * Formats a byte count as a human-readable size.
     */
    public static function humanReadableBytes(int|float $bytes, int $precision = 2): string
    {
        $bytes = (float) $bytes;
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);
        $value = $bytes / (1024 ** $power);

        return round($value, $precision) . ' ' . $units[$power];
    }

    /**
     * Abbreviates a large number (1200 => "1.2K", 3500000 => "3.5M").
     */
    public static function abbreviate(int|float $number, int $precision = 1): string
    {
        $number = (float) $number;
        $abs = abs($number);
        $sign = $number < 0 ? '-' : '';

        if ($abs < 1000) {
            return $sign . round($abs, $precision);
        }

        $units = ['', 'K', 'M', 'B', 'T'];
        $power = min((int) floor(log($abs, 1000)), count($units) - 1);
        $value = $abs / (1000 ** $power);

        return $sign . round($value, $precision) . $units[$power];
    }
}
