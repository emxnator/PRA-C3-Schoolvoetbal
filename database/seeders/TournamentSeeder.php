<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tournament;
use Carbon\Carbon;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournaments = [
            [
                'name' => 'Voetbal Groep 3/4 Toernooi',
                'datum' => Carbon::create(2025, 12, 15),
                'fields_amount' => 4,
                'game_length_minutes' => 15,
                'amount_teams_pool' => 4,
                'archived' => false,
            ],
            [
                'name' => 'Voetbal Groep 5/6 Toernooi',
                'datum' => Carbon::create(2025, 12, 20),
                'fields_amount' => 5,
                'game_length_minutes' => 20,
                'amount_teams_pool' => 5,
                'archived' => false,
            ],
            [
                'name' => 'Voetbal Groep 7/8 Toernooi',
                'datum' => Carbon::create(2026, 1, 10),
                'fields_amount' => 6,
                'game_length_minutes' => 25,
                'amount_teams_pool' => 6,
                'archived' => false,
            ],
            [
                'name' => 'Lijnbal Groep 7/8 Meiden',
                'datum' => Carbon::create(2025, 12, 22),
                'fields_amount' => 3,
                'game_length_minutes' => 20,
                'amount_teams_pool' => 4,
                'archived' => false,
            ],
        ];

        foreach ($tournaments as $tournament) {
            Tournament::create($tournament);
        }
    }
}
