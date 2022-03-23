<?php

namespace App\Providers;

use App\Repositories\FootballTeam\FootballTeamRepository;
use App\Repositories\FootballTeam\FootballTeamRepositoryInterface;
use App\Repositories\LeagueResult\LeagueResultRepository;
use App\Repositories\LeagueResult\LeagueResultRepositoryInterface;
use App\Repositories\MatchResult\MatchResultRepositoryInterface;
use App\Repositories\MatchResult\MatchResultRepository;
use App\Repositories\MatchSchedule\MatchScheduleRepository;
use App\Repositories\MatchSchedule\MatchScheduleRepositoryInterface;
use App\Repositories\TeamPrediction\TeamPredictionRepository;
use App\Repositories\TeamPrediction\TeamPredictionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MatchResultRepositoryInterface::class,
            MatchResultRepository::class
        );

        $this->app->bind(
            FootballTeamRepositoryInterface::class,
            FootballTeamRepository::class
        );

        $this->app->bind(
            MatchScheduleRepositoryInterface::class,
            MatchScheduleRepository::class
        );

        $this->app->bind(
            LeagueResultRepositoryInterface::class,
            LeagueResultRepository::class
        );

        $this->app->bind(
            TeamPredictionRepositoryInterface::class,
            TeamPredictionRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
