<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * @param string $text
     * @return array
     */
    public static function explodeBlankSpace(string $text)
    {
        return explode(' ', $text);
    }
}
