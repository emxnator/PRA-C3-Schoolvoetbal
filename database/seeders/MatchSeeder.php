<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MatchModel;
use App\Models\Team;
use App\Models\Tournament;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();
        $tournament1 = Tournament::where('name', 'Voetbal Groep 3/4 Toernooi')->first();
        $tournament2 = Tournament::where('name', 'Voetbal Groep 5/6 Toernooi')->first();

        $matches = [
            // Tournament 1 matches
            [
                'team_1_id' => $teams[0]->id,
                'team_2_id' => $teams[1]->id,
                'team_1_score' => 3,
                'team_2_score' => 2,
                'field' => 1,
                'referee' => 'Jan de Vries',
                'start_time' => '09:00:00',
                'type' => 'poule',
                'tournament_id' => $tournament1->id,
            ],
            [
                'team_1_id' => $teams[2]->id,
                'team_2_id' => $teams[3]->id,
                'team_1_score' => 1,
                'team_2_score' => 1,
                'field' => 2,
                'referee' => 'Piet Jansen',
                'start_time' => '09:00:00',
                'type' => 'poule',
                'tournament_id' => $tournament1->id,
            ],
            [
                'team_1_id' => $teams[0]->id,
                'team_2_id' => $teams[2]->id,
                'team_1_score' => null,
                'team_2_score' => null,
                'field' => 1,
                'referee' => 'Klaas Bakker',
                'start_time' => '09:30:00',
                'type' => 'poule',
                'tournament_id' => $tournament1->id,
            ],
            [
                'team_1_id' => $teams[4]->id,
                'team_2_id' => $teams[5]->id,
                'team_1_score' => 2,
                'team_2_score' => 0,
                'field' => 3,
                'referee' => 'Dirk Peters',
                'start_time' => '09:00:00',
                'type' => 'poule',
                'tournament_id' => $tournament1->id,
            ],
            
            // Tournament 2 matches
            [
                'team_1_id' => $teams[8]->id,
                'team_2_id' => $teams[9]->id,
                'team_1_score' => null,
                'team_2_score' => null,
                'field' => 1,
                'referee' => 'Anna van Dam',
                'start_time' => '10:00:00',
                'type' => 'poule',
                'tournament_id' => $tournament2->id,
            ],
            [
                'team_1_id' => $teams[10]->id,
                'team_2_id' => $teams[11]->id,
                'team_1_score' => null,
                'team_2_score' => null,
                'field' => 2,
                'referee' => 'Lisa Koster',
                'start_time' => '10:00:00',
                'type' => 'poule',
                'tournament_id' => $tournament2->id,
            ],
        ];

        foreach ($matches as $match) {
            MatchModel::create($match);
        }
    }
}
