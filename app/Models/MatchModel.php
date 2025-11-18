<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'team_1_id',
        'team_2_id',
        'team_1_score',
        'team_2_score',
        'field',
        'referee',
        'start_time',
        'type',
        'tournament_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
