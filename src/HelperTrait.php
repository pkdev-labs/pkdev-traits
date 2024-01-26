<?php

namespace PkDev\Traits;

trait HelperTrait
{
    /**
     * Generates a random string
     * @param $length
     * @return string
     */
    public static function generateRandomString($length = 10): string
    {
        $characters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[array_rand($characters)];
        }

        return $randomString;
    }
}