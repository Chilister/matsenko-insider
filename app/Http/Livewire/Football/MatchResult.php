<?php

namespace App\Http\Livewire\Football;

use App\Repositories\MatchResult\MatchResultRepositoryInterface;
use Livewire\Component;

class MatchResult extends Component
{
    public ?int $matchId = null;
    public ?int $week = null;
    private MatchResultRepositoryInterface $matchResultRepository;

    protected $listeners = ['games_played' => 'refreshResults'];

    public function boot(MatchResultRepositoryInterface $matchResultRepository)
    {
        $this->matchResultRepository = $matchResultRepository;
    }

    public function refreshResults($params)
    {
        $this->matchId = $params['matchId'];
    }

    public function render()
    {
        return view('livewire.football.match-result', [
            'matchResults' => $this->matchId === null
                ? null
                : $this->matchResultRepository->getMatchResultsByMatchId($this->matchId)
        ]);
    }
}
