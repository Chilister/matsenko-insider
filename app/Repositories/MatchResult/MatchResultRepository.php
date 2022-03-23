<?php

namespace App\Repositories\MatchResult;

use App\Models\MatchResult;
use App\Repositories\FootballTeam\FootballTeamRepositoryInterface;
use App\Repositories\MatchSchedule\MatchScheduleRepositoryInterface;
use App\Services\Football\MatchService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class MatchResultRepository implements MatchResultRepositoryInterface
{
    /**
     * MatchResultRepositoryRepository constructor.
     * @param MatchResult|null $matchResult
     * @param FootballTeamRepositoryInterface $footballTeamRepository
     * @param MatchScheduleRepositoryInterface $matchScheduleRepository
     */
    public function __construct(
        protected MatchResult|null $matchResult,
        protected FootballTeamRepositoryInterface $footballTeamRepository,
        protected MatchScheduleRepositoryInterface $matchScheduleRepository
    ){
        $this->matchResult = $this->getLastMatch();
    }

    /**
     * @return int
     */
    public function getPlayedWeek(): int
    {
        return MatchResult::latest('league_id')->max('week') ?? 1;
    }

    /**
     * @param int $matchId
     * @return int
     */
    public function getMatchesCountByMatchId(int $matchId):int
    {
        return MatchResult::where('match_id', $matchId)->count();
    }

    /**
     * @param int $leagueId
     * @return int
     */
    public function getMatchesCountByLeagueId(int $leagueId):int
    {
        return MatchResult::where('league_id', $leagueId)->count();
    }

    /**
     * @return int
     */
    public function getLastMatchId(): int
    {
        return MatchResult::max('match_id') ?? 1;
    }

    /**
     * @return MatchResult|null
     */
    public function getLastMatch(): ?MatchResult
    {
        return MatchResult::latest('match_id')->first();
    }

    /**
     * @param array $matchResultDetails
     * @return void
     * @throws Exception
     */
    public function storeMatchResult(array $matchResultDetails): void
    {
        $this->matchResult = MatchResult::create(
            array_merge(
                [
                    'first_team_result' => MatchService::generateGoalsNumber(),
                    'second_team_result' => MatchService::generateGoalsNumber()
                ],
                $matchResultDetails
            )
        );
    }

    /**
     * @return int
     */
    public function getCurrentMatchId(): int
    {
        $lastMatch = $this->getLastMatch();
        if ($lastMatch === null) {
            return 1;
        }
        if ($this->footballTeamRepository->getRoundLimit() === $this->getMatchesCountByMatchId($lastMatch->match_id)) {
            return ++$lastMatch->match_id;
        }

        return $lastMatch->match_id;
    }

    public function getCurrentLeagueId(): int
    {
        $lastMatch = $this->getLastMatch();
        if ($lastMatch === null) {
            return 1;
        }
        if ($this->isLeagueEnds($lastMatch->league_id)) {
            return ++$lastMatch->league_id;
        }

        return $lastMatch->league_id;
    }

    /**
     * @param int $leagueId
     * @return bool
     */
    public function isLeagueEnds(int $leagueId): bool
    {
        return $this->getMatchesCountByLeagueId($leagueId) === $this->matchScheduleRepository->getAllMatchesCount();
    }

    public function isLeagueStart(int $leagueId): bool
    {
        return $this->getMatchesCountByLeagueId($leagueId) <= $this->footballTeamRepository->getRoundLimit();
    }


    /**
     * @param int $matchId
     * @return Collection<MatchResult>
     */
    public function getMatchResultsByMatchId(int $matchId): Collection
    {
        return MatchResult::where('match_id', $matchId)->get();
    }
}
