<?php

namespace Tests\Feature;

use App\Http\Livewire\Football\WeekPrediction;
use App\Models\FootballTeam;
use App\Models\TeamPrediction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;
use Tests\TestCase;

class TeamPredictionTest extends TestCase
{
    public function test_is_prediction_view_correct()
    {
        $team = FootballTeam::whereSlug('liverpool')->first();
        $teamPrediction = TeamPrediction::factory()
            ->state(['team_id' => $team->id, 'percent' => 2500, 'match_id' => now()->timestamp])
            ->create();
        Livewire::test(WeekPrediction::class, ['matchId' => $teamPrediction->match_id])
            ->assertSee(['Liverpool', '25%']);
        $teamPrediction->delete();
    }

    public function test_is_prediction_without_data_view_correct()
    {
        Livewire::test(WeekPrediction::class)->assertSee('League is not started yet');
    }
}
