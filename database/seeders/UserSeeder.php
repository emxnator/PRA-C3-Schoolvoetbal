<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@school.nl',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'is_super_admin' => true,
            'phonenumber' => '0612345678',
        ]);

        // Regular users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.nl',
            'password' => Hash::make('john123'),
            'is_admin' => false,
            'phonenumber' => '0687654321',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.nl',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'phonenumber' => '0698765432',
        ]);

        User::create([
            'name' => 'Peter van Bergen',
            'email' => 'peter@example.nl',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'phonenumber' => '0611223344',
        ]);
    }
}
