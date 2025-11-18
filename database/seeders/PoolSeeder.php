<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pool;
use App\Models\Tournament;

class PoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournament1 = Tournament::where('name', 'Voetbal Groep 3/4 Toernooi')->first();
        $tournament2 = Tournament::where('name', 'Voetbal Groep 5/6 Toernooi')->first();
        $tournament3 = Tournament::where('name', 'Voetbal Groep 7/8 Toernooi')->first();
        $tournament4 = Tournament::where('name', 'Lijnbal Groep 7/8 Meiden')->first();

        $pools = [
            ['tournament_id' => $tournament1->id, 'name' => 'Poule A'],
            ['tournament_id' => $tournament1->id, 'name' => 'Poule B'],
            
            ['tournament_id' => $tournament2->id, 'name' => 'Poule A'],
            ['tournament_id' => $tournament2->id, 'name' => 'Poule B'],
            ['tournament_id' => $tournament2->id, 'name' => 'Poule C'],
            
            ['tournament_id' => $tournament3->id, 'name' => 'Poule A'],
            ['tournament_id' => $tournament3->id, 'name' => 'Poule B'],
            
            ['tournament_id' => $tournament4->id, 'name' => 'Poule A'],
            ['tournament_id' => $tournament4->id, 'name' => 'Poule B'],
        ];

        foreach ($pools as $pool) {
            Pool::create($pool);
        }
    }
}
