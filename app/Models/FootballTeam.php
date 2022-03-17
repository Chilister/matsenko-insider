<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballTeam extends Model
{
    use HasFactory;

    protected $table = 'football_teams';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function homeMatchResults()
    {
        return $this->hasManyThrough(
            MatchResult::class,
            MatchSchedule::class,
            'first_team_id', // Foreign key on the environments table...
            'schedule_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }

    public function abroadMatchResults()
    {
        return $this->hasManyThrough(
            MatchResult::class,
            MatchSchedule::class,
            'second_team_id', // Foreign key on the environments table...
            'schedule_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
}
