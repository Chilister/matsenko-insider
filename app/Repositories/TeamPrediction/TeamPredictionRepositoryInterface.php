<?php

namespace App\Repositories\TeamPrediction;

use App\Models\TeamPrediction;
use Illuminate\Database\Eloquent\Collection;

interface TeamPredictionRepositoryInterface
{
    /**
     * @param int $matchId
     * @return Collection<TeamPrediction>
     */
    public function getPercentOrderedByMatchId(int $matchId): Collection;

    /**
     * @param int $teamId
     * @param int $matchId
     * @param int $percent
     * @return TeamPrediction
     */
    public function updateOrCreatePredictionPercent(int $teamId, int $matchId, int $percent): TeamPrediction;
}
