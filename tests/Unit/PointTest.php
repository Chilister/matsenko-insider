<?php

namespace Tests\Unit;

use App\Services\Football\PointService;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function test_percent_per_point_calculating()
    {
        $this->assertSame(20.0, PointService::calculatePercentPerPoint(5));
    }

    public function test_percent_calculating()
    {
        $this->assertSame(20.0, PointService::calculatePercent(1, 5));
    }
}
