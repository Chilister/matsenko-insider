<?php

namespace App\Services\Football;

use App\Models\MatchSchedule;
use App\Repositories\LeagueResult\LeagueResultRepositoryInterface;
use App\Repositories\MatchResult\MatchResultRepositoryInterface;
use JetBrains\PhpStorm\ArrayShape;

class MatchService
{
    /**
     * MatchService constructor.
     * @param ScheduleService $scheduleService
     * @param LeagueResultService $leagueResultService
     * @param MatchResultRepositoryInterface $matchResultRepository
     * @param LeagueResultRepositoryInterface $leagueResultRepository
     */
    public function __construct(
        private ScheduleService $scheduleService,
        private LeagueResultService $leagueResultService,
        private MatchResultRepositoryInterface $matchResultRepository,
        private LeagueResultRepositoryInterface $leagueResultRepository
    ) {
    }

    /**
     * @return int
     * @throws \Exception
     */
    public static function generateGoalsNumber(): int
    {
        return random_int(0, 1000) % 7;
    }

    public function getMatchId(): int
    {
        return $this->matchResultRepository->getLastMatchId();
    }

    public function playGames()
    {
        foreach ($this->scheduleService->getCurrentWeekSchedules() as $schedule) {
            $this->playScheduleGame($schedule);
            $this->storeLeagueResult($schedule);
        }
    }

    /**
     * @param MatchSchedule $schedule
     * @return void
     */
    private function playScheduleGame(MatchSchedule $schedule): void
    {
        $this->matchResultRepository->storeMatchResult([
            'week' => $schedule->week,
            'schedule_id' => $schedule->id,
            'match_id' => $this->matchResultRepository->getCurrentMatchId(),
            'league_id' => $this->matchResultRepository->getCurrentLeagueId()
        ]);
    }

    /**
     * @param MatchSchedule $schedule
     * @return void
     */
    private function storeLeagueResult(MatchSchedule $schedule): void
    {
        $preparedMatchResult = $this->prepareMatchResult();
        $lastMatch = $this->matchResultRepository->getLastMatch();
        $isLeagueStart = $this->matchResultRepository->isLeagueStart($lastMatch->league_id);
        $this->leagueResultRepository->storeLeagueResult(
            $this->leagueResultService->prepareLeagueResultData(
                $schedule->first_team_id,
                $lastMatch->match_id,
                $preparedMatchResult['first_team'],
                $isLeagueStart
            )
        );
        $this->leagueResultRepository->storeLeagueResult(
            $this->leagueResultService->prepareLeagueResultData(
                $schedule->second_team_id,
                $lastMatch->match_id,
                $preparedMatchResult['second_team'],
                $isLeagueStart
            )
        );
    }

    /**
     * @return array[]
     */
    #[ArrayShape(['first_team' => "array", 'second_team' => "array"])] private function prepareMatchResult(): array
    {
        $matchResult = $this->matchResultRepository->getLastMatch();
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
