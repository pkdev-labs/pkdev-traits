<?php

namespace PkDev\Traits;

trait SanitizeTrait
{
    public static function sanitizeString($value)
    {
        $value = trim($value);
        $value = strip_tags($value);
        return (string)$value;
    }
}