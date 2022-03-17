<?php

namespace App\Http\Livewire\Football;

use Livewire\Component;

class MatchSchedule extends Component
{
    public function render()
    {
        return view('livewire.football.match-schedule', [
            'schedules' => \App\Models\MatchSchedule::all()
        ]);
    }
}
