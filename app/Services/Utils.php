<?php

namespace App\Services;

use Carbon\Carbon;

class Utils
{
    public static function getUserTimezone()
    {
        return "Europe/Budapest";
    }

    public static function formatDate(Carbon|\DateTime $date): string
    {
        if ($date instanceof \DateTime)
        {
            $date = Carbon::parse($date);
        }

        // TODO: Need to change the timezone here to the current users timezone if applicable.
        return $date->setTimezone(self::getUserTimezone())->format("Y-m-d H:i:s");
    }
}
