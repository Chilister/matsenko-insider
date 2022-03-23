<?php

namespace App\Repositories\MatchResult;

use App\Models\MatchResult;
use Illuminate\Database\Eloquent\Collection;

interface MatchResultRepositoryInterface
{
    /**
     * @return int
     */
    public function getPlayedWeek(): int;

    /**
     * @return int
     */
    public function getLastMatchId(): int;

    /**
     * @return MatchResult|null
     */
    public function getLastMatch(): ?MatchResult;

    /**
     * @return int
     */
    public function getCurrentMatchId(): int;

    /**
     * @return int
     */
    public function getCurrentLeagueId(): int;

    /**
     * @param int $matchId
     * @return int
     */
    public function getMatchesCountByMatchId(int $matchId): int;

    /**
     * @param int $leagueId
     * @return int
     */
    public function getMatchesCountByLeagueId(int $leagueId): int;

    /**
     * @param array $matchResultDetails
     * @return void
     */
    public function storeMatchResult(array $matchResultDetails):void;

    /**
     * @param int $leagueId
     * @return bool
     */
    public function isLeagueEnds(int $leagueId): bool;

    /**
     * @param int $leagueId
     * @return bool
     */
    public function isLeagueStart(int $leagueId): bool;

    /**
     * @param int $matchId
     * @return Collection<MatchResult>
     */
    public function getMatchResultsByMatchId(int $matchId): Collection;
}
