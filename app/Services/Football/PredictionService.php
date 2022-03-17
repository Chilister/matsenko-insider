<?php

namespace App\Services\Football;

use App\Models\League;
use App\Models\TeamPrediction;
use Illuminate\Support\Collection;

class PredictionService
{
    /**
     * @param int $matchId
     * @return void
     */
    public static function calculatePrediction(int $matchId): void
    {
        $leagues = League::where('match_id', $matchId)->get();
        $goalDifferenceAverage = $leagues->avg('goal_difference') + 0.01;
        foreach ($leagues as $league) {
            $percentage = new Collection([
                [
                    'action' => config('football.action.win'),
                    'percent' => PointService::calculatePercent($league->won, $league->plays)
                ],
                [
                    'action' => config('football.action.drawn'),
                    'percent' => PointService::calculatePercent($league->drawn, $league->plays)
                ],
                [
                    'action' => config('football.action.lost'),
                    'percent' => PointService::calculatePercent($league->lost, $league->plays)
                ]
            ]);
            $action = self::getGoalDifferenceCorrectAction($goalDifferenceAverage, $league->goal_difference);
            $percentage = self::addGoalDifferencePercent($percentage, $action);
            $maxPercent = $percentage->sortByDesc('percent')->first();
            $league->points += PointService::getPoints($maxPercent['action']);
        }
        self::storePredictions($leagues, $matchId);
    }

    /**
     * @param float $goalDifferenceAverage
     * @param int $goalDifference
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function getGoalDifferenceCorrectAction(float $goalDifferenceAverage, int $goalDifference)
    {
        $diffRate = round($goalDifference / $goalDifferenceAverage, 2);
        if ($diffRate > config('football.goal_difference.top_rate')) {
            return config('football.action.win');
        }
        if ($diffRate < config('football.goal_difference.bottom_rate')) {
            return config('football.action.lost');
        }

        return config('football.action.drawn');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $leagues
     * @param int $matchId
     * @return void
     */
    private static function storePredictions(\Illuminate\Database\Eloquent\Collection $leagues, int $matchId): void
    {
        $percentPerPoint = PointService::calculatePercentPerPoint($leagues->sum('points'));
        foreach ($leagues as $league) {
            TeamPrediction::updateOrCreate(
                ['team_id' => $league->team_id, 'match_id' => $matchId],
                ['percent' => round($percentPerPoint * $league->points, 2) * 100]
            );
        }
    }

    /**
     * @param Collection $results
     * @param int $action
     * @return Collection
     */
    private static function addGoalDifferencePercent(Collection $results, int $action): Collection
    {
        return $results->map(function ($row) use ($action) {
            if ($row['action'] === $action) {
                $row['percent'] += config('football.goal_difference.additional_percent');
            }
            return ['action' => $row['action'], 'percent' => $row['percent']];
        });
    }
}
