<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\School;
use App\Models\Pool;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();
        $pools = Pool::all();

        $teams = [
            // Tournament 1: Voetbal Groep 3/4 (6 teams total, 3 per pool)
            // Pool 1 (Poule A)
            ['school_id' => $schools[0]->id, 'referee' => 'Jan de Vries', 'name' => 'De Wilgen A1', 'pool_id' => $pools[0]->id],
            ['school_id' => $schools[1]->id, 'referee' => 'Piet Jansen', 'name' => 'Het Centrum A1', 'pool_id' => $pools[0]->id],
            ['school_id' => $schools[2]->id, 'referee' => 'Klaas Bakker', 'name' => 'De Regenboog A1', 'pool_id' => $pools[0]->id],
            
            // Pool 2 (Poule B)
            ['school_id' => $schools[3]->id, 'referee' => 'Hans Mulder', 'name' => 'Sint-Jan B1', 'pool_id' => $pools[1]->id],
            ['school_id' => $schools[4]->id, 'referee' => 'Dirk Peters', 'name' => 'De Berk B1', 'pool_id' => $pools[1]->id],
            ['school_id' => $schools[5]->id, 'referee' => 'Tom Visser', 'name' => 'Zuiderhof B1', 'pool_id' => $pools[1]->id],
            
            // Tournament 2: Voetbal Groep 5/6 (9 teams total, 3 per pool)
            // Pool 3 (Poule A)
            ['school_id' => $schools[6]->id, 'referee' => 'Anna van Dam', 'name' => 'De Kameleon A2', 'pool_id' => $pools[2]->id],
            ['school_id' => $schools[7]->id, 'referee' => 'Lisa Koster', 'name' => 'Montessori A2', 'pool_id' => $pools[2]->id],
            ['school_id' => $schools[0]->id, 'referee' => 'Sophie Meijer', 'name' => 'De Wilgen A2', 'pool_id' => $pools[2]->id],
            
            // Pool 4 (Poule B)
            ['school_id' => $schools[1]->id, 'referee' => 'Emma de Boer', 'name' => 'Het Centrum B2', 'pool_id' => $pools[3]->id],
            ['school_id' => $schools[2]->id, 'referee' => 'Julia Vos', 'name' => 'De Regenboog B2', 'pool_id' => $pools[3]->id],
            ['school_id' => $schools[3]->id, 'referee' => 'Sarah Jansen', 'name' => 'Sint-Jan B2', 'pool_id' => $pools[3]->id],
            
            // Pool 5 (Poule C)
            ['school_id' => $schools[4]->id, 'referee' => 'Frank Peters', 'name' => 'De Berk C2', 'pool_id' => $pools[4]->id],
            ['school_id' => $schools[5]->id, 'referee' => 'Linda Smit', 'name' => 'Zuiderhof C2', 'pool_id' => $pools[4]->id],
            ['school_id' => $schools[6]->id, 'referee' => 'Rob van Dam', 'name' => 'De Kameleon C2', 'pool_id' => $pools[4]->id],
            
            // Tournament 3: Voetbal Groep 7/8 (6 teams total, 3 per pool)
            // Pool 6 (Poule A)
            ['school_id' => $schools[7]->id, 'referee' => 'David Meijer', 'name' => 'Montessori A3', 'pool_id' => $pools[5]->id],
            ['school_id' => $schools[0]->id, 'referee' => 'Nicole de Boer', 'name' => 'De Wilgen A3', 'pool_id' => $pools[5]->id],
            ['school_id' => $schools[1]->id, 'referee' => 'Chris Vos', 'name' => 'Het Centrum A3', 'pool_id' => $pools[5]->id],
            
            // Pool 7 (Poule B)
            ['school_id' => $schools[2]->id, 'referee' => 'Sandra Peters', 'name' => 'De Regenboog B3', 'pool_id' => $pools[6]->id],
            ['school_id' => $schools[3]->id, 'referee' => 'Marc Smit', 'name' => 'Sint-Jan B3', 'pool_id' => $pools[6]->id],
            ['school_id' => $schools[4]->id, 'referee' => 'Eva van Dam', 'name' => 'De Berk B3', 'pool_id' => $pools[6]->id],
            
            // Tournament 4: Lijnbal Groep 7/8 Meiden (6 teams total, 3 per pool)
            // Pool 8 (Poule A)
            ['school_id' => $schools[5]->id, 'referee' => 'Jolanda Smit', 'name' => 'Zuiderhof Meiden A', 'pool_id' => $pools[7]->id],
            ['school_id' => $schools[6]->id, 'referee' => 'Marieke van Dam', 'name' => 'De Kameleon Meiden A', 'pool_id' => $pools[7]->id],
            ['school_id' => $schools[7]->id, 'referee' => 'Annemarie Jansen', 'name' => 'Montessori Meiden A', 'pool_id' => $pools[7]->id],
            
            // Pool 9 (Poule B)
            ['school_id' => $schools[0]->id, 'referee' => 'Bianca Koster', 'name' => 'De Wilgen Meiden B', 'pool_id' => $pools[8]->id],
            ['school_id' => $schools[1]->id, 'referee' => 'Carla Meijer', 'name' => 'Het Centrum Meiden B', 'pool_id' => $pools[8]->id],
            ['school_id' => $schools[2]->id, 'referee' => 'Diana de Boer', 'name' => 'De Regenboog Meiden B', 'pool_id' => $pools[8]->id],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
