<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\UsersCompaniesSeeder;
use Database\Seeders\users_historiesSeeder;
use Database\Seeders\users_skillsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UsersSeeder::class);
        $this->call(UsersCompaniesSeeder::class);
        $this->call(users_historiesSeeder::class);
        $this->call(users_skillsSeeder::class);
    }
}
