<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    protected $fillable = [
        'tournament_id',
        'name',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function matches()
    {
        return $this->hasMany(MatchModel::class);
    }

    public function getStandings()
    {
        $teams = $this->teams;
        $matches = $this->matches()->whereNotNull('team_1_score')->whereNotNull('team_2_score')->get();

        $standings = $teams->map(function ($team) use ($matches) {
            $played = 0;
            $won = 0;
            $drawn = 0;
            $lost = 0;
            $goalsFor = 0;
            $goalsAgainst = 0;
            $points = 0;

            foreach ($matches as $match) {
                if ($match->team_1_id == $team->id) {
                    $played++;
                    $goalsFor += $match->team_1_score;
                    $goalsAgainst += $match->team_2_score;

                    if ($match->team_1_score > $match->team_2_score) {
                        $won++;
                        $points += 3;
                    } elseif ($match->team_1_score == $match->team_2_score) {
                        $drawn++;
                        $points += 1;
                    } else {
                        $lost++;
                    }
                } elseif ($match->team_2_id == $team->id) {
                    $played++;
                    $goalsFor += $match->team_2_score;
                    $goalsAgainst += $match->team_1_score;

                    if ($match->team_2_score > $match->team_1_score) {
                        $won++;
                        $points += 3;
                    } elseif ($match->team_2_score == $match->team_1_score) {
                        $drawn++;
                        $points += 1;
                    } else {
                        $lost++;
                    }
                }
            }

            return [
                'team' => $team,
                'played' => $played,
                'won' => $won,
                'drawn' => $drawn,
                'lost' => $lost,
                'goals_for' => $goalsFor,
                'goals_against' => $goalsAgainst,
                'goal_difference' => $goalsFor - $goalsAgainst,
                'points' => $points,
            ];
        });

        // Sort by Points, then Goal Difference, then Goals For
        return $standings->sort(function ($a, $b) {
            if ($a['points'] !== $b['points']) {
                return $b['points'] <=> $a['points'];
            }
            if ($a['goal_difference'] !== $b['goal_difference']) {
                return $b['goal_difference'] <=> $a['goal_difference'];
            }
            return $b['goals_for'] <=> $a['goals_for'];
        });
    }
}
