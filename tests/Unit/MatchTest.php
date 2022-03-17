<?php

namespace Tests\Unit;

use App\Services\Football\MatchService;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_first_league_id_generation()
    {
        $this->assertSame(1, MatchService::generateLeagueId());
    }

    public function test_next_league_id_generation()
    {
        $this->assertSame(2, MatchService::generateLeagueId(1));
    }

    public function test_first_match_id_generation()
    {
        $this->assertSame(1, MatchService::generateMatchId());
    }

    public function test_next_match_id_generation()
    {
        $this->assertSame(2, MatchService::generateMatchId(1));
    }

    public function test_goal_number_generation_format()
    {
        $this->assertIsInt(MatchService::generateGoalsNumber());
    }
}
