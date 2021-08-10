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

    /**
     * @param string $text
     * @param string $rule
     * @param string $replace
     * @return string|string[]|null
     */
    public static function replaceRegex(string $text, string $rule, string $replace)
    {
        return preg_replace($rule, $replace, $text);
    }
}
