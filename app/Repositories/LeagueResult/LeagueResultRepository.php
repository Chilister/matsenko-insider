<?php

namespace App\Repositories\LeagueResult;

use App\Models\League;
use Illuminate\Database\Eloquent\Collection;

class LeagueResultRepository implements LeagueResultRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function storeLeagueResult(array $details): League
    {
        return League::create($details);
    }

    /**
     * @param int $matchId
     * @return Collection<League>
     */
    public function getOrderedLeagueByMatchId(int $matchId): Collection
    {
        return League::where('match_id', $matchId)
            ->orderByDesc('points')
            ->orderByDesc('goal_difference')
            ->get();
    }

    /**
     * @param int $matchId
     * @return Collection<League>
     */
    public function getLeagueResultsByMatchId(int $matchId): Collection
    {
        return League::where('match_id', $matchId)->get();
    }

    /**
     * @param int $matchId
     * @param int $teamId
     * @return League|null
     */
    public function getLeagueByMatchAndTeamId(int $matchId, int $teamId): ?League
    {
        return League::where('match_id', $matchId)
            ->where('team_id', $teamId)
            ->first();
    }
}
