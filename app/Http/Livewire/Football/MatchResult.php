<?php

namespace App\Http\Livewire\Football;

use Livewire\Component;

class MatchResult extends Component
{
    public ?int $matchId = null;

    protected $listeners = ['games_played' => 'refreshResults'];

    public function refreshResults($params)
    {
        $this->matchId = $params['matchId'];
    }

    public function render()
    {
        return view('livewire.football.match-result', [
            'matchResults' => $this->matchId === null
                ? null
                :\App\Models\MatchResult::where('match_id', $this->matchId)->get()
        ]);
    }
}
