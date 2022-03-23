<?php

namespace App\Http\Livewire\Football;

use App\Repositories\MatchResult\MatchResultRepositoryInterface;
use App\Services\Football\MatchService;
use Livewire\Component;

class MainPage extends Component
{
    private MatchService $matchService;
    private MatchResultRepositoryInterface $matchResultRepository;

    public function boot(MatchResultRepositoryInterface $matchResultRepository, MatchService $matchService)
    {
        $this->matchResultRepository = $matchResultRepository;
        $this->matchService = $matchService;
    }

    public function playGames()
    {
        $this->matchService->playGames();
        $this->emit('games_played', [
            'matchId' => $this->matchResultRepository->getLastMatchId()
        ]);
    }

    public function render()
    {
        $lastMatch = $this->matchResultRepository->getLastMatch();

        return view('livewire.football.main-page', [
            'matchId' => $lastMatch?->match_id,
            'week' => $lastMatch?->week,
            'leagueId' => $lastMatch?->league_id,
            'isLeagueEnds' => !($lastMatch === null) && $this->matchResultRepository->isLeagueEnds($lastMatch->league_id)
        ]);
    }
}
