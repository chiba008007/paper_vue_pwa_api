<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users_skillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users_skills')->delete();
        DB::table('users_skills')->insert([
            [
                'user_id' => "1",
                'note' => 'ファイナンシャルプランナー技能士',
                "order"=>1,
                'created_at' => now()
            ],
            [
                'user_id' => "1",
                'note' => '中小企業診断士',
                "order"=>2,
                'created_at' => now()
            ]
            ]);
    }
}
