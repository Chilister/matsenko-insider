<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPrediction extends Model
{
    use HasFactory;

    protected $table = 'team_predictions';

    protected $fillable = [
        'team_id',
        'match_id',
        'percent',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function team()
    {
        return $this->belongsTo(FootballTeam::class, 'team_id', 'id');
    }

    public function matchResult()
    {
        return $this->belongsTo(MatchResult::class, 'match_id', 'match_id');
    }


}
