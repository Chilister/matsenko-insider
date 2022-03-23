<?php

namespace App\Services\Football;

use App\Models\FootballTeam;
use App\Models\MatchSchedule;
use App\Repositories\FootballTeam\FootballTeamRepositoryInterface;
use App\Repositories\MatchResult\MatchResultRepositoryInterface;
use App\Repositories\MatchSchedule\MatchScheduleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Schedule;
use ScheduleBuilder;

class ScheduleService
{
    public function __construct(
        private MatchResultRepositoryInterface   $matchResultRepository,
        private MatchScheduleRepositoryInterface $matchScheduleRepository
    )
    {
    }

    /**
     * @return Collection<MatchSchedule>
     */
    public function getCurrentWeekSchedules(): Collection
    {
        $lastMatch = $this->matchResultRepository->getLastMatch();
        if ($lastMatch === null) {
            return $this->matchScheduleRepository->getFirstWeekSchedules();
        }
        if ($this->matchResultRepository->isLeagueEnds($lastMatch->league_id)) {
            return $this->matchScheduleRepository->getFirstWeekSchedules();
        }

        return $this->matchScheduleRepository->getSchedulesByWeek(++$lastMatch->week);
    }

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
