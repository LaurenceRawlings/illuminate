<?php


namespace App\Helpers;


class Utils
{
    public static function isValidUrl($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function formatViewCount(int $views): string
    {
        if ($views < 1000) {
            $views_format = number_format($views);
        } else if ($views < 1000000) {
            $views_format = number_format($views / 1000, 1).'K';
        } else if ($views < 1000000000) {
            $views_format = number_format($views / 1000000, 2).'M';
        } else {
            $views_format = number_format($views / 1000000000, 3).'B';
        }

        return $views_format;
    }
}
