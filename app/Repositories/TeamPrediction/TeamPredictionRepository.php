<?php

namespace App\Repositories\TeamPrediction;

use App\Models\TeamPrediction;
use Illuminate\Database\Eloquent\Collection;

class TeamPredictionRepository implements TeamPredictionRepositoryInterface
{

    /**
     * @param int $matchId
     * @return Collection<TeamPrediction>
     */
    public function getPercentOrderedByMatchId(int $matchId): Collection
    {
        return TeamPrediction::where('match_id', $matchId)->orderByDesc('percent')->get();
    }

    public function updateOrCreatePredictionPercent(int $teamId, int $matchId, int $percent): TeamPrediction
    {
        return TeamPrediction::updateOrCreate(
            ['team_id' => $teamId, 'match_id' => $matchId],
            ['percent' => $percent]
        );
    }
}
