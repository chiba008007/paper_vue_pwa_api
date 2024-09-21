<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users_historiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users_histories')->delete();
        DB::table('users_histories')->insert([
            [
                'user_id' => "1",
                'title' => "OpenAI",
                'note' => 'ソフトウェアエンジニア,
2020年10月 - 現在
自然言語処理システムの開発と改善に従事。
GPTシリーズのアーキテクチャの維持と拡張を担当。
ディープラーニングモデルの最適化とスケーラビリティの向上に取り組む',
                "order"=>1,
                'created_at' => now()
            ],
            [
                'user_id' => "1",
                'title' => "PHP エンジニア",
                'note' => 'WEBエンジニア,
2020年10月 - 2023年10月
WEB言語',
                "order"=>2,
                'created_at' => now()
            ]
            ]);
    }
}
