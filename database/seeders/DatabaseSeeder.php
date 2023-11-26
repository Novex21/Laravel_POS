<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'testuser1@test.com',
            'phone' =>'11-223366',
            'password' => bcrypt('password'),
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'testuser2@test.com',
            'phone' =>'+2434-5566',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'testuser3@test.com',
            'phone' =>'+9655-55-66',
            'password' => bcrypt('password'),
        ]);

    }
}
