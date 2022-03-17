<?php

namespace App\Services\Football;

use App\Models\MatchResult;

class MatchService
{
    /**
     * @param int $leagueId
     * @return int
     */
    public static function generateLeagueId(int $leagueId = 0): int
    {
        return ++$leagueId;
    }

    /**
     * @param int $matchId
     * @return int
     */
    public static function generateMatchId(int $matchId = 0): int
    {
        return ++$matchId;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public static function generateGoalsNumber(): int
    {
        return random_int(0, 1000) % 7;
    }


    /**
     * @param MatchResult $matchResult
     * @return array[]
     */
    public static function prepareMatchResult(MatchResult $matchResult): array
    {
        if ($matchResult->first_team_result > $matchResult->second_team_result) {
            return [
                'first_team' => [
                    'action' => config('football.action.win'),
                    'goal_difference' => $matchResult->first_team_result - $matchResult->second_team_result
                ],
                'second_team' => [
                    'action' => config('football.action.lost'),
                    'goal_difference' => $matchResult->second_team_result - $matchResult->first_team_result
                ],
            ];
        }
        if ($matchResult->first_team_result < $matchResult->second_team_result) {
            return [
                'first_team' => [
                    'action' => config('football.action.lost'),
                    'goal_difference' => $matchResult->first_team_result - $matchResult->second_team_result
                ],
                'second_team' => [
                    'action' => config('football.action.win'),
                    'goal_difference' => $matchResult->second_team_result - $matchResult->first_team_result
                ],
            ];
        }

        return [
            'first_team' => [
                'action' => config('football.action.drawn'),
                'goal_difference' => 0
            ],
            'second_team' => [
                'action' => config('football.action.drawn'),
                'goal_difference' => 0
            ],
        ];
    }
}
