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
                'address' => "〒260-8667
千葉市中央区市場町1番1号
電話番号:043-223-2110
                ",
                'map_url'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3243.9387834527943!2d140.1231956!3d35.6045766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60229b35a48e42cf%3A0x49ec45e2db5c49d0!2z44CSMjYwLTA4NTUg5Y2D6JGJ55yM5Y2D6JGJ5biC5Lit5aSu5Yy65biC5aC055S677yR4oiS77yR!5e0!3m2!1sja!2sjp!4v1726320000477!5m2!1sja!2sjp",
                "order"=>1,
                'created_at' => now()
            ],
            [
                'user_id' => "1",
                'address' => "〒630-8501
奈良市登大路町30
電話番号 0742-22-1101
                ",
                'map_url'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.8077615233383!2d135.83096810925846!3d34.6848009839563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60013985e944261f%3A0xc71de77884c3d826!2z44CSNjMwLTgyMTMg5aWI6Imv55yM5aWI6Imv5biC55m75aSn6Lev55S677yT77yQ!5e0!3m2!1sja!2sjp!4v1726320138542!5m2!1sja!2sjp",
                "order"=>2,
                'created_at' => now()
            ]
        ]);
    }
}
