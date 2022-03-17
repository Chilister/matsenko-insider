<?php

namespace Tests\Feature;

use App\Http\Livewire\Football\LeagueResult;
use App\Models\FootballTeam;
use App\Models\League;
use Livewire\Livewire;
use Tests\TestCase;

class LeagueResultTest extends TestCase
{
    public function test_is_prediction_view_correct()
    {
        $team = FootballTeam::whereSlug('liverpool')->first();
        $league = League::factory()
            ->state([
                'team_id' => $team->id,
                'points' => 123,
                'plays' => 321,
                'won' => 111,
                'drawn' => 222,
                'lost' => 333,
                'goal_difference' => -44,
                'match_id' => now()->timestamp
            ])->create();
        Livewire::test(LeagueResult::class, ['matchId' => $league->match_id])
            ->assertSee(['Liverpool', '123','321','111','222','333','-44']);
        $league->delete();
    }

    public function test_is_league_without_data_view_correct()
    {
        Livewire::test(LeagueResult::class)->assertSee('Team');
    }
}
