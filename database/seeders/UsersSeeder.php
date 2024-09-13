<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->delete();
        DB::table('users')->insert([
            [

            'code' => "chiba00807",
            'name' => "佐藤 タロウ",
            'email' => "password@gmail.com",
            'email_verified_at' => now(),
            'password' => password_hash('password',PASSWORD_DEFAULT),
            'remember_token' => Str::random(10),
            'created_at' => now()
            ],


        ]);
    }
}
