<?php

namespace Database\Factories;

use App\Models\FootballTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FootballTeam>
 */
class FootballTeamFactory extends Factory
{
    protected $model = FootballTeam::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Chelsee-' . now()->timestamp,
            'slug' => 'Chelsee-' . now()->timestamp
        ];
    }
}
