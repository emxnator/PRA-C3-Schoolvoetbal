<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',
        'datum',
        'fields_amount',
        'game_length_minutes',
        'amount_teams_pool',
        'archived',
    ];

    protected $casts = [
        'datum' => 'date',
        'archived' => 'boolean',
    ];

    public function pools()
    {
        return $this->hasMany(Pool::class);
    }

    public function matches()
    {
        return $this->hasMany(MatchModel::class);
    }

    public function getRandomPoolTeamsCountAttribute()
    {
        $randomPool = $this->pools()->inRandomOrder()->first();
        return $randomPool ? $randomPool->teams()->count() : 0;
    }
}
