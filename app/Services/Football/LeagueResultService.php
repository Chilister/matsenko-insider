<?php

namespace App\Services\Football;

use App\Models\League;

class LeagueResultService
{
    /**
     * @param int $teamId
     * @param int $matchId
     * @param array $matchWinner
     * @param bool $isLeagueEnds
     * @return array
     */
    public static function prepareLeagueResultData(int $teamId, int $matchId, array $matchWinner, bool $isLeagueEnds = false): array
    {
        $previousResult = $isLeagueEnds ? null : League::where('match_id', $matchId - 1)
            ->where('team_id', $teamId)
            ->first();
        $resultData = [
            'team_id' => $teamId,
            'points' => (int)($previousResult?->points) + PointService::getPoints($matchWinner['action']),
            'plays' => (int)($previousResult?->plays) + 1,
            'goal_difference' => (int)($previousResult?->goal_difference) + $matchWinner['goal_difference'],
            'match_id' => $matchId,
            'won' => (int)($previousResult?->won),
            'drawn' => (int)($previousResult?->drawn),
            'lost' => (int)($previousResult?->lost)
        ];
        switch ($matchWinner['action']) {
            case config('football.action.win'):
                ++$resultData['won'];
                break;
            case config('football.action.drawn'):
                ++$resultData['drawn'];
                break;
            case config('football.action.lost'):
                ++$resultData['lost'];
                break;
        }

        return $resultData;
    }
}
