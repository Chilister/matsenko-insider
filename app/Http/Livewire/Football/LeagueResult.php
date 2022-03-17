<?php

namespace App\Http\Livewire\Football;

use App\Models\League;
use Livewire\Component;

class LeagueResult extends Component
{
    public ?int $matchId = null;

    protected $listeners = ['games_played' => 'refreshLeague'];

    public function refreshLeague($params): void
    {
        $this->matchId = $params['matchId'];
    }

    public function render()
    {
        return view('livewire.football.league-result', [
            'leagueResults' => $this->matchId === null ? [] : League::where('match_id', $this->matchId)
                ->orderByDesc('points')
                ->orderByDesc('goal_difference')
                ->get()
        ]);
    }
}
