<?php

namespace Tests\Feature;

use App\Services\Football\PredictionService;
use Tests\TestCase;

class GoalDifferenceTest extends TestCase
{
    public function test_goal_difference_win_action()
    {
        $this->assertSame(
            config('football.action.win'),
            PredictionService::getGoalDifferenceCorrectAction(5, 9)
        );
    }

    public function test_goal_difference_drawn_action()
    {
        $this->assertSame(
            config('football.action.drawn'),
            PredictionService::getGoalDifferenceCorrectAction(5, 5)
        );
    }

    public function test_goal_difference_lost_action()
    {
        $this->assertSame(
            config('football.action.lost'),
            PredictionService::getGoalDifferenceCorrectAction(5, 1)
        );
    }
}
