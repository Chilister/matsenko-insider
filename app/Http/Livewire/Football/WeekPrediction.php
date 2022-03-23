<?php

namespace App\Http\Livewire\Football;

use App\Repositories\TeamPrediction\TeamPredictionRepositoryInterface;
use App\Services\Football\PredictionService;
use Livewire\Component;

class WeekPrediction extends Component
{
    public ?int $matchId = null;
    public ?int $week = null;
    private PredictionService $predictionService;
    private TeamPredictionRepositoryInterface $teamPredictionRepository;

    protected $listeners = ['games_played' => 'calculatePrediction'];

    public function boot(PredictionService $predictionService, TeamPredictionRepositoryInterface $teamPredictionRepository)
    {
        $this->predictionService = $predictionService;
        $this->teamPredictionRepository = $teamPredictionRepository;
    }

    public function calculatePrediction($params)
    {
        $this->matchId = $params['matchId'];
        $this->predictionService->calculatePrediction($this->matchId);
    }

    public function render()
    {
        return view('livewire.football.week-prediction', [
            'teamPredictions' => $this->matchId === null
                ? null
                : $this->teamPredictionRepository->getPercentOrderedByMatchId($this->matchId),
        ]);
    }
}
