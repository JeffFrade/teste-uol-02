<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * @param $date
     * @param $format
     * @return string
     */
    public static function formatDateWithoutCarbon($date, $format)
    {
        $formatted = '';

        if ($date != null) {
            $date = Carbon::parse($date);

            $formatted = $date->format($format);
        }

        return $formatted;
    }
}
