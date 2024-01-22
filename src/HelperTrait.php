<?php

namespace PkDev\Traits;

trait HelperTrait
{
    public static function generateRandomString($length = 10)
    {
        $characters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[array_rand($characters)];
        }

        return $randomString;
    }
}