<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function formatDateWithoutCarbon(string $date, string $format)
    {
        $formatted = '';

        if ($date != null) {
            $date = Carbon::parse($date);

            $formatted = $date->format($format);
        }

        return $formatted;
    }

    /**
     * @param string $date
     * @return string
     */
    public static function formatBrDate(string $date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}
