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
        'pool_id',
        'round',
        'next_match_id',
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

    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    public function nextMatch()
    {
        return $this->belongsTo(MatchModel::class, 'next_match_id');
    }

    public function previousMatches()
    {
        return $this->hasMany(MatchModel::class, 'next_match_id');
    }

    protected static function booted()
    {
        static::saved(function ($match) {
            if ($match->next_match_id && !is_null($match->team_1_score) && !is_null($match->team_2_score)) {
                $winnerId = null;
                if ($match->team_1_score > $match->team_2_score) {
                    $winnerId = $match->team_1_id;
                } elseif ($match->team_2_score > $match->team_1_score) {
                    $winnerId = $match->team_2_id;
                }

                if ($winnerId) {
                    $nextMatch = $match->nextMatch;
                    if ($nextMatch) {
                        if ($nextMatch->team_1_id == $match->team_1_id || $nextMatch->team_1_id == $match->team_2_id) {
                            $nextMatch->update(['team_1_id' => $winnerId]);
                        } elseif ($nextMatch->team_2_id == $match->team_1_id || $nextMatch->team_2_id == $match->team_2_id) {
                            $nextMatch->update(['team_2_id' => $winnerId]);
                        } elseif (is_null($nextMatch->team_1_id)) {
                            $nextMatch->update(['team_1_id' => $winnerId]);
                        } elseif (is_null($nextMatch->team_2_id)) {
                            $nextMatch->update(['team_2_id' => $winnerId]);
                        }
                    }
                }
            }
        });
    }
}
