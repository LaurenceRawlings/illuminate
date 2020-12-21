<?php


namespace App\Helpers;


class Utils
{
    public static function isValidUrl($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function formatCount(int $count): string
    {
        if ($count < 1000) {
            $views_format = number_format($count);
        } else if ($count < 1000000) {
            $views_format = number_format($count / 1000, 1) . 'K';
        } else if ($count < 1000000000) {
            $views_format = number_format($count / 1000000, 2) . 'M';
        } else {
            $views_format = number_format($count / 1000000000, 3) . 'B';
        }

        return $views_format;
    }
}
