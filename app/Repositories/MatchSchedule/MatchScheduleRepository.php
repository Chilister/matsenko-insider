<?php

namespace App\Repositories\MatchSchedule;

use App\Models\MatchSchedule;
use App\Repositories\FootballTeam\FootballTeamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MatchScheduleRepository implements MatchScheduleRepositoryInterface
{
    public function __construct(protected FootballTeamRepositoryInterface $footballTeamRepository)
    {
    }

    /**
     * @return Collection<MatchSchedule>
     */
    public function getFirstWeekSchedules(): Collection
    {
        return MatchSchedule::oldest('week')
            ->limit($this->footballTeamRepository->getRoundLimit())
            ->get();
    }


    /**
     * @return int
     */
    public function getAllMatchesCount(): int
    {
        return MatchSchedule::count();
    }

    /**
     * @param int $weekId
     * @return Collection<MatchSchedule>
     */
    public function getSchedulesByWeek(int $weekId): Collection
    {
        return MatchSchedule::where('week', $weekId)
            ->limit($this->footballTeamRepository->getRoundLimit())
            ->get();
    }

    /**
     * @return Collection<MatchSchedule>
     */
    public function getAllSchedules(): Collection
    {
        return MatchSchedule::all();
    }
}
