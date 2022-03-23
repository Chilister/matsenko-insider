<?php

namespace App\Repositories\MatchSchedule;

use App\Models\MatchSchedule;
use Illuminate\Database\Eloquent\Collection;

interface MatchScheduleRepositoryInterface
{
    /**
     * @return Collection<MatchSchedule>
     */
    public function getFirstWeekSchedules(): Collection;


    /**
     * @return Collection<MatchSchedule>
     */
    public function getAllSchedules(): Collection;

    /**
     * @return int
     */
    public function getAllMatchesCount(): int;

    /**
     * @param int $weekId
     * @return Collection<MatchSchedule>
     */
    public function getSchedulesByWeek(int $weekId): Collection;
}
