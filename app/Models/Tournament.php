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

    public function generatePlayoffs()
    {
        $pools = $this->pools;

        if ($pools->count() < 2) {
            return; // Not enough pools for playoffs
        }

        // Assuming 2 pools for this specific logic (A and B)
        $poolA = $pools[0];
        $poolB = $pools[1];

        $standingsA = $poolA->getStandings()->values();
        $standingsB = $poolB->getStandings()->values();

        if ($standingsA->count() < 4 || $standingsB->count() < 4) {
            return; // Not enough teams for quarterfinals (need at least 4 per pool)
        }

        // Get top 4 teams from each pool
        $teamA1 = $standingsA[0]['team'];
        $teamA2 = $standingsA[1]['team'];
        $teamA3 = $standingsA[2]['team'];
        $teamA4 = $standingsA[3]['team'];
        $teamB1 = $standingsB[0]['team'];
        $teamB2 = $standingsB[1]['team'];
        $teamB3 = $standingsB[2]['team'];
        $teamB4 = $standingsB[3]['team'];

        // Create Final Match first
        $finalMatch = MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => null,
            'team_2_id' => null,
            'round' => 'final',
            'field' => 1,
            'referee' => 'TBD',
            'start_time' => now()->addHours(3),
            'type' => 'playoff',
        ]);

        // Create Semi-Finals (with placeholders)
        $semi1 = MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => null,
            'team_2_id' => null,
            'round' => 'semi',
            'next_match_id' => $finalMatch->id,
            'field' => 1,
            'referee' => 'TBD',
            'start_time' => now()->addHours(2),
            'type' => 'playoff',
        ]);

        $semi2 = MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => null,
            'team_2_id' => null,
            'round' => 'semi',
            'next_match_id' => $finalMatch->id,
            'field' => 2,
            'referee' => 'TBD',
            'start_time' => now()->addHours(2),
            'type' => 'playoff',
        ]);

        // Create Quarter-Finals
        // Quarter 1: A1 vs B4
        MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => $teamA1->id,
            'team_2_id' => $teamB4->id,
            'round' => 'quarter',
            'next_match_id' => $semi1->id,
            'field' => 1,
            'referee' => 'TBD',
            'start_time' => now()->addHours(1),
            'type' => 'playoff',
        ]);

        // Quarter 2: A4 vs B1
        MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => $teamA4->id,
            'team_2_id' => $teamB1->id,
            'round' => 'quarter',
            'next_match_id' => $semi1->id,
            'field' => 2,
            'referee' => 'TBD',
            'start_time' => now()->addHours(1),
            'type' => 'playoff',
        ]);

        // Quarter 3: A2 vs B3
        MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => $teamA2->id,
            'team_2_id' => $teamB3->id,
            'round' => 'quarter',
            'next_match_id' => $semi2->id,
            'field' => 3,
            'referee' => 'TBD',
            'start_time' => now()->addHours(1),
            'type' => 'playoff',
        ]);

        // Quarter 4: A3 vs B2
        MatchModel::create([
            'tournament_id' => $this->id,
            'team_1_id' => $teamA3->id,
            'team_2_id' => $teamB2->id,
            'round' => 'quarter',
            'next_match_id' => $semi2->id,
            'field' => 4,
            'referee' => 'TBD',
            'start_time' => now()->addHours(1),
            'type' => 'playoff',
        ]);
    }
}

