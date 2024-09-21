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
            'tel' => "090-1234-1234",
            'post' => "987-2202",
            'pref' => "宮城県",
            'address' => "青葉区木町10-20",
            'display_name' => "佐藤 タロウ",
            'syozoku' => "開発部",
            'kana' => "さとうたろう",
            'myimage_path' => "http://arch.casio.jp/image/dc/images/EXZR400CIMG5739_s.jpg",
            "company_name" => "サンプル株式会社",
            "company_image_path" => "https://logodx.com/samplelogo/sa2.jpg",
            "company_url" => "https://innovation-gate.jp/",
            "profile" => "
私は自然言語処理と人工知能の分野で豊富な経験を持つソフトウェアエンジニアです。これまでのキャリアで、次のような経験を積んできました：
技術的な深さと広さ:
深層学習モデルの開発や最適化、自然言語理解システムの設計・実装に携わり、高度な技術的課題に対処してきました。
チームでの協力:
大規模なプロジェクトでのチームワークを重視し、他のメンバーとの密接な連携を通じて、成果を最大化することに努めています。
問題解決能力:
複雑な問題に対して論理的かつ創造的なアプローチで取り組むことが得意であり、常に効率的な解決策を追求しています。
継続的な学びと成長:
技術の進化に常に対応するために、新しいアルゴリズムやツールについて学び続け、自己成長を維持しています。
私はチャレンジを楽しみ、新しい技術やアイデアを探求することに情熱を持っています。革新的なプロジェクトに貢献し、技術の進化に寄与することを目指しています。
            ",
            'remember_token' => Str::random(10),
            'created_at' => now()
            ],
            [
            'code' => "sample",
            'name' => "佐藤 いいいい",
            'email' => "sample@gmail.com",
            'email_verified_at' => now(),
            'password' => password_hash('sample',PASSWORD_DEFAULT),
            'tel' => "090-1234-1234",
            'post' => "987-2202",
            'pref' => "宮城県",
            'address' => "青葉区木町10-20",
            'display_name' => "佐藤 いいいいい",
            'syozoku' => "開発部",
            'kana' => "ええええ",
            'myimage_path' => "http://arch.casio.jp/image/dc/images/EXZR400CIMG5739_s.jpg",
            "company_name" => "サンプル株式会社",
            "company_image_path" => "https://logodx.com/samplelogo/sa2.jpg",
            "company_url" => "https://innovation-gate.jp/",
            "profile" => "ああああ",
            'remember_token' => Str::random(10),
            'created_at' => now()
            ],


        ]);
    }
}
