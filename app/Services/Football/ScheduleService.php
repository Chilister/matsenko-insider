<?php

namespace App\Services\Football;

use App\Models\FootballTeam;
use App\Models\MatchSchedule;
use Schedule;
use ScheduleBuilder;

class ScheduleService
{
    /**
     * @return void
     */
    public static function calculateSchedule(): void
    {
        $teams = FootballTeam::all();
        $scheduleBuilder = new ScheduleBuilder($teams->pluck('id')->toArray());
        MatchSchedule::truncate();
        self::storeHomeSchedule($scheduleBuilder->build()->full());
        self::storeAwaySchedule($scheduleBuilder->build()->full());
    }

    /**
     * @param array $schedule
     * @return void
     */
    private static function storeHomeSchedule(array $schedule): void
    {
        foreach ($schedule as $weekNumber => $week) {
            foreach ($week as $teams) {
                MatchSchedule::store(array_shift($teams), array_shift($teams), $weekNumber);
            }
        }
    }

    /**
     * @param array $schedule
     * @return void
     */
    private static function storeAwaySchedule(array $schedule): void
    {
        foreach ($schedule as $weekNumber => $week) {
            foreach ($week as $teams) {
                MatchSchedule::store(array_pop($teams), array_pop($teams), $weekNumber + 3);
            }
        }
    }
}
