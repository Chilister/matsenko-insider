<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchSchedule extends Model
{
    use HasFactory;

    protected $table = 'match_schedule';

    protected $fillable = [
        'first_team_id',
        'second_team_id',
        'week'
    ];

    public function matches()
    {
        return $this->hasMany(MatchResult::class, 'schedule_id', 'id');
    }

    public static function store(int $firstTeamId, int $secondTeamId, int $week)
    {
        self::create([
            'first_team_id' => $firstTeamId,
            'second_team_id' => $secondTeamId,
            'week' => $week
        ]);
    }

    public function firstTeam()
    {
        return $this->belongsTo(FootballTeam::class, 'first_team_id', 'id');
    }

    public function secondTeam()
    {
        return $this->belongsTo(FootballTeam::class, 'second_team_id', 'id');
    }

    public function weekMatches()
    {
        return $this->hasMany(MatchResult::class,'week', 'week');
    }
}
