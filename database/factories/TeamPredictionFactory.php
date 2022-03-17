<?php

namespace Database\Factories;

use App\Models\TeamPrediction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamPrediction>
 */
class TeamPredictionFactory extends Factory
{

    protected $model = TeamPrediction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'team_id' => random_int(1, 100),
            'percent' => random_int(0, 10) * 10,
            'match_id' => random_int(1, 5),
            'created_at' => (string)Carbon::now()->timestamp,
            'updated_at' => (string)Carbon::now()->timestamp
        ];
    }
}
