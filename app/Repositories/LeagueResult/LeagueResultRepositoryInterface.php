<?php

namespace App\Repositories\LeagueResult;

use App\Models\League;
use Illuminate\Database\Eloquent\Collection;

interface LeagueResultRepositoryInterface
{

    /**
     * @param array $details
     * @return League
     */
    public function storeLeagueResult(array $details): League;

    /**
     * @param int $matchId
     * @return Collection<League>
     */
    public function getOrderedLeagueByMatchId(int $matchId): Collection;

    /**
     * @param int $matchId
     * @return Collection<League>
     */
    public function getLeagueResultsByMatchId(int $matchId): Collection;

    /**
     * @param int $matchId
     * @param int $teamId
     * @return League|null
     */
    public function getLeagueByMatchAndTeamId(int $matchId, int $teamId): ?League;
}
