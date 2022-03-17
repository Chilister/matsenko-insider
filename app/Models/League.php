<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $table = 'league';

    protected $fillable =  [
        'team_id',
        'points',
        'plays',
        'won',
        'drawn',
        'lost',
        'goal_difference',
        'match_id'
    ];

    public function team()
    {
        return $this->belongsTo(FootballTeam::class, 'team_id', 'id');
    }

    public function matchResults()
    {
        return $this->belongsTo(MatchResult::class, 'match_id', 'id');
    }
}
