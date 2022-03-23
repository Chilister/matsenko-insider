<?php

namespace App\Http\Livewire\Football;

use App\Repositories\MatchSchedule\MatchScheduleRepositoryInterface;
use Livewire\Component;

class MatchSchedule extends Component
{
    public ?int $week = null;
    private MatchScheduleRepositoryInterface $matchScheduleRepository;

    public function boot(MatchScheduleRepositoryInterface $matchScheduleRepository)
    {
        $this->matchScheduleRepository = $matchScheduleRepository;
    }

    public function render()
    {
        return view('livewire.football.match-schedule', [
            'schedules' => $this->matchScheduleRepository->getAllSchedules()
        ]);
    }
}
