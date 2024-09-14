<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users_companies')->delete();
        DB::table('users_companies')->insert([
            [
                'user_id' => "1",
                'address' => "東京本社の住所",
                'map_url'=>"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3243.1797907341056!2d139.7381620757852!3d35.62329397260596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z5p2x5Lqs6YO95ZOB5bed5Yy6MeS4geebrjAtMCDjgrXjg7Pjg5fjg6vjg5Pjg6vlk4Hlt50xM0Y!5e0!3m2!1sja!2sjp!4v1720959078762!5m2!1sja!2sjp",
                "order"=>1,
                'created_at' => now()
            ],
            [
                'user_id' => "1",
                'address' => "大阪本社の住所",
                'map_url'=>"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3243.1797907341056!2d139.7381620757852!3d35.62329397260596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z5p2x5Lqs6YO95ZOB5bed5Yy6MeS4geebrjAtMCDjgrXjg7Pjg5fjg6vjg5Pjg6vlk4Hlt50xM0Y!5e0!3m2!1sja!2sjp!4v1720959078762!5m2!1sja!2sjp",
                "order"=>2,
                'created_at' => now()
            ]
        ]);
    }
}
