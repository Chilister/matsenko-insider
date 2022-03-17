<?php

namespace App\Services\Football;

class PointService
{
    public static function getPoints(int $action)
    {
        if ($action === config('football.action.win')) {
            return config('football.point.win');
        }
        if ($action === config('football.action.drawn')) {
            return config('football.point.drawn');
        }

        return config('football.point.lost');
    }

    public static function calculatePercentPerPoint(int $pointsSum): float
    {
        return round(100 / $pointsSum, 2);
    }

    /**
     * @param int $mainValue
     * @param int $totalValue
     * @return float
     */
    public static function calculatePercent(int $mainValue, int $totalValue): float
    {
        return round(($mainValue / $totalValue) * 100, 2);
    }
}
