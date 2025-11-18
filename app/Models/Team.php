<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'school_id',
        'referee',
        'name',
        'pool_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(MatchModel::class, 'team_1_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(MatchModel::class, 'team_2_id');
    }
}
