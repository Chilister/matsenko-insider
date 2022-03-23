<?php

namespace App\Services\Football;

use App\Repositories\LeagueResult\LeagueResultRepositoryInterface;

class LeagueResultService
{
    public function __construct(
        private LeagueResultRepositoryInterface $leagueResultRepository
    ){
    }

    /**
     * @param int $teamId
     * @param int $matchId
     * @param array $matchWinner
     * @param bool $isLeagueStart
     * @return array
     */
    public function prepareLeagueResultData(int $teamId, int $matchId, array $matchWinner, bool $isLeagueStart = false): array
    {
        $previousResult = $isLeagueStart
            ? null
            : $this->leagueResultRepository->getLeagueByMatchAndTeamId($matchId - 1, $teamId);
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
