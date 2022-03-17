<?php

namespace App\Http\Livewire\Football;

use App\Models\TeamPrediction;
use App\Services\Football\PredictionService;
use Livewire\Component;

class WeekPrediction extends Component
{
    public ?int $matchId = null;

    protected $listeners = ['games_played' => 'calculatePrediction'];

    public function calculatePrediction($params)
    {
        $this->matchId = $params['matchId'];
        PredictionService::calculatePrediction($this->matchId);
    }

    public function render()
    {
        return view('livewire.football.week-prediction', [
            'teamPredictions' => $this->matchId === null
                ? null
                :TeamPrediction::where('match_id', $this->matchId)->orderByDesc('percent')->get(),
        ]);
    }
}
