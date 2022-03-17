<?php

namespace App\Http\Livewire\Football;

use App\Models\FootballTeam;
use App\Models\League;
use App\Models\MatchResult;
use App\Models\MatchSchedule;
use App\Services\Football\LeagueResultService;
use App\Services\Football\MatchService;
use Livewire\Component;

class MainPage extends Component
{
    public ?int $leagueId = null;
    public ?int $matchId = null;
    public ?int $week = null;
    public bool $isLeagueEnds = false;

    public function mount()
    {
        $this->matchId = MatchResult::max('match_id');
    }

    public function render()
    {
        return view('livewire.football.main-page');
    }

    /**
     * @return int
     */
    private static function calculateIterationCount(): int
    {
        $lastMatch = MatchResult::latest('league_id')->first();
        $maxScheduleWeek = MatchSchedule::max('week');
        if ($lastMatch->week === $maxScheduleWeek) {
            return $maxScheduleWeek;
        }

        return $maxScheduleWeek - $lastMatch->week;
    }

    public function playGames()
    {
        $playedWeek = MatchResult::latest('league_id')->max('week');
        $roundLimit = FootballTeam::count() / 2;
        if ($playedWeek === null) {
            $this->playFirstGames($roundLimit);
        } else {
            $this->playNextGames($roundLimit);
        }
        $this->emit('games_played', ['matchId' => $this->matchId]);
    }

    private function playFirstGames(int $roundLimit)
    {
        $this->leagueId = MatchService::generateLeagueId();
        $this->matchId = MatchService::generateMatchId();
        $schedules = MatchSchedule::oldest('week')->limit($roundLimit)->get();
        $this->storeMatchResults($schedules);
        $this->storeLeagueResults();
    }

    private function playNextGames(int $roundLimit)
    {
        $lastMatchResult = MatchResult::latest()->first();
        $schedulesCount = MatchSchedule::count();
        $matchesCount = MatchResult::where('league_id', $lastMatchResult->league_id)->count();
        $this->isLeagueEnds = $matchesCount === $schedulesCount;
        if ($this->isLeagueEnds) {
            $this->leagueId = MatchService::generateLeagueId($lastMatchResult->league_id);
            $schedules = MatchSchedule::oldest('week')->limit($roundLimit)->get();
        } else {
            $this->leagueId = $lastMatchResult->league_id;
            $schedules = MatchSchedule::where('week', $lastMatchResult->week + 1)
                ->oldest('week')
                ->limit($roundLimit)
                ->get();
        }
        $this->matchId = MatchService::generateMatchId($lastMatchResult->match_id);
        $this->storeMatchResults($schedules);
        $this->storeLeagueResults();
    }

    /**
     * @param $schedules
     * @return void
     * @throws \Exception
     */
    private function storeMatchResults($schedules): void
    {
        /** @var MatchSchedule $schedule */
        foreach ($schedules as $schedule) {
            /** @var MatchResult $matchResult */
            $schedule->matches()->create([
                'first_team_result' => MatchService::generateGoalsNumber(),
                'second_team_result' => MatchService::generateGoalsNumber(),
                'week' => $schedule->week,
                'match_id' => $this->matchId,
                'league_id' => $this->leagueId
            ]);
        }
        $this->week = $schedule->week;
    }

    /**
     * @return void
     */
    private function storeLeagueResults(): void
    {
        $matchResults = MatchResult::where('match_id', $this->matchId)->get();
        foreach ($matchResults as $matchResult){
            $preparedMatchResult = MatchService::prepareMatchResult($matchResult);
            League::create(
                LeagueResultService::prepareLeagueResultData(
                    $matchResult->schedule->first_team_id,
                    $this->matchId,
                    $preparedMatchResult['first_team'],
                    $this->isLeagueEnds
                )
            );
            League::create(
                LeagueResultService::prepareLeagueResultData(
                    $matchResult->schedule->second_team_id,
                    $this->matchId,
                    $preparedMatchResult['second_team'],
                    $this->isLeagueEnds
                )
            );
        }
    }


}
