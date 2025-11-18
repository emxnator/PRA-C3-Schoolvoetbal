<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\User;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('email', 'john@example.nl')->first();
        $user2 = User::where('email', 'jane@example.nl')->first();
        $user3 = User::where('email', 'peter@example.nl')->first();

        $schools = [
            ['name' => 'Basisschool De Wilgen', 'creator_id' => $user1->id],
            ['name' => 'OBS Het Centrum', 'creator_id' => $user1->id],
            ['name' => 'Basisschool De Regenboog', 'creator_id' => $user2->id],
            ['name' => 'Katholieke Basisschool Sint-Jan', 'creator_id' => $user2->id],
            ['name' => 'Basisschool De Berk', 'creator_id' => $user3->id],
            ['name' => 'Openbare Basisschool Zuiderhof', 'creator_id' => $user3->id],
            ['name' => 'Basisschool De Kameleon', 'creator_id' => $user1->id],
            ['name' => 'Montessori School Bergen op Zoom', 'creator_id' => $user2->id],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}
