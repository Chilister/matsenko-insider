<?php

namespace Tests\Unit;

use App\Services\Football\MatchService;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{

    public function test_goal_number_generation_format()
    {
        $this->assertIsInt(MatchService::generateGoalsNumber());
    }
}
