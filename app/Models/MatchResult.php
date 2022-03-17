<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    use HasFactory;

    protected $table = 'match_results';

    protected $fillable = [
        'schedule_id',
        'first_team_result',
        'second_team_result',
        'week',
        'match_id',
        'league_id',
    ];

    public function schedule()
    {
        return $this->belongsTo(MatchSchedule::class, 'schedule_id', 'id');
    }

    public function league()
    {
        return $this->hasOne(League::class, 'match_id', 'match_id');
    }
}
