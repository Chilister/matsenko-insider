<?php

namespace Database\Factories;

use App\Models\FootballTeam;
use App\Models\League;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeagueFactory extends Factory
{
    protected $model = League::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $wins = random_int(0, 50);
        $drawn = random_int(0, 50);
        $lost = random_int(0, 50);
        return [
            'team_id' => FootballTeam::all()->shuffle()->first()->id,
            'points' => $wins * 3 + $drawn,
            'plays' => $wins + $drawn + $lost,
            'won' => $wins,
            'drawn' => $drawn,
            'lost' => $lost,
            'goal_difference' => random_int(-10, 20),
            'match_id' => now()->timestamp
        ];
    }
}
