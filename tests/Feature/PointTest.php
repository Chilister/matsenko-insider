<?php

namespace Tests\Feature;

use App\Services\Football\PointService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{
    public function test_win_point_calculating()
    {
        $this->assertSame(
            config('football.point.win'),
            PointService::getPoints(config('football.action.win'))
        );
    }

    public function test_drawn_point_calculating()
    {
        $this->assertSame(
            config('football.point.drawn'),
            PointService::getPoints(config('football.action.drawn'))
        );
    }

    public function test_lost_point_calculating()
    {
        $this->assertSame(
            config('football.point.drawn'),
            PointService::getPoints(config('football.action.drawn'))
        );
    }
}
