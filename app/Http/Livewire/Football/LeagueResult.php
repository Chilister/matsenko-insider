<?php

namespace App\Http\Livewire\Football;

use App\Repositories\LeagueResult\LeagueResultRepositoryInterface;
use Livewire\Component;

class LeagueResult extends Component
{
    public ?int $matchId = null;
    private LeagueResultRepositoryInterface $leagueResultRepository;

    protected $listeners = ['games_played' => 'refreshLeague'];

    public function boot(LeagueResultRepositoryInterface $leagueResultRepository)
    {
        $this->leagueResultRepository = $leagueResultRepository;
    }

    public function refreshLeague($params): void
    {
        $this->matchId = $params['matchId'];
    }

    public function render()
    {
        return view('livewire.football.league-result', [
            'leagueResults' => $this->matchId === null
                ? []
                : $this->leagueResultRepository->getOrderedLeagueByMatchId($this->matchId)
        ]);
    }
}
