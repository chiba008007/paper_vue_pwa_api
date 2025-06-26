<?php

namespace App\Consts;

class CommonConst
{
    public const ADMINMAIL = "admin@myselfpaper.online";
    public const ADMINDOMAIN = "https://myselfpaper.online";
    public const LOCALDOMAIN = "http://localhost:8080";
    public const IMAGEPATH = "/storage/app/myImage/";
    public const IMAGEDIR = "/public/app/myImage/";
    public const STRAGEIMAGE = "/storage/app/myImage/";

    public const TEMPLATE1 = [
        "section1" => true,
        "section2" => true,
        "section3" => true,
        "section4" => true,
        "section5" => true,
        "top" => '/default/template1/top.png',
        "human" => '/default/template1/human.png',
        "ya_image" => '/default/template1/ya.png',
        "title1_image" => '/default/template1/title1.png',
        "image1" => '/default/template1/image1.mp4',
        "image2" => '/default/template1/image2.png',
        "image3" => '/default/template1/image3.png',
        "image4" => '/default/template1/image4.png',
        "image5" => '/default/template1/image5.png',
        "text1" => '〇〇大学 〇〇祭実行委員会',
        "text2" => '渉外局2年',
        "text3" => '〇〇学部',
        "text4" => '〇〇県出身',
        "name" => "スポネク 太郎",
        "kana" => "Taro Sponnect",
        "mail" => "〇〇〇〇@ 〇〇. c o m",
        "title1" => "about",
        "text5" => "〇〇大学 〇〇祭実行委員会",
        "text6" => "所属学生数",
        "text7" => "〇〇〇人( 1 年〇〇人/ 2 年〇〇人/ 3 年〇〇人）",
        "text8" => "男女比",
        "text9" => "〇:〇",
        "text10" => "公式HP",
        "text11" => "h t t p s : / / 〇〇〇〇〇〇",
        "text12" => "M a i l",
        "text13" => "〇〇〇〇@ 〇〇〇〇. c o m",
        "text14" => "TEL",
        "text15" => "0 3 - 〇〇〇〇- 〇〇〇〇",
        "text16" => "開催日時",
        "text17" => "2 0 2 5 / 〇〇/ 〇〇 ~ 〇〇",
        "text18" => "開催場所",
        "text19" => "東京都〇〇区〇〇",
        "text20" => "参加団体数",
        "text21" => "〇〇〇団体",
        "text22" => "想定来場者数",
        "text23" => "約〇〇〇〇人",
        "textarea1" => "大学祭の詳細やテーマ 特色などなど
文字の大きさ・色・配置・装飾などを自分たちで設定。 フリーテキストエリア
フリーテキストエリア フリーテキストエリア フリーテキストエリア
フリーテキストエリア フリーテキストエリア フリーテキストエリア
フリーテキストエリア",
        "text24" => "後援",
        "text25" => "〇〇〇〇",
        "charttitle" => "来場者数",
        "pietitle1" => "来場者分布1",
        "pietitle2" => "来場者分布2",
        "textarea2" => "アピールポイントなど。
フリーテキストエリア フリーテキストエリア フリーテキストエリア フリーテキストエリア
フリーテキストエリア フリーテキストエリア フリーテキストエリア フリーテキストエリア
フリーテキストエリア フリーテキストエリア フリーテキストエリア フリーテキストエリア
フリーテキストエリア フリーテキストエリア フリーテキストエリア フリーテキストエリア",
        "title2" => "plan",
        "button_label" => "資料Download",
        "button_link" => "http://www.",
        "button_text" => "企画書をダウンロードしてご覧いただけます。",
        "title3" => "schedule",
        "title4" => "track record",
        "text26" => "昨年度の協賛金総額",
        "money" => "¥ 0,000,000",
        "text27" => "使用用途",
        "title5" => "SNS",
        "title6" => "CONTACT",
        "text28" => "下記連絡先まで、ご連絡ください。",
        "contact_mail" => "〇〇〇〇@〇〇〇〇.com",
        "contact_tel" => "03-〇〇〇〇-〇〇〇〇",
        "chart_labels" => ["2021", "2022", "2023", "2024", "2025(目標)"],
        "chart_data" => [8000, 9000, 13000, 15000, 18000],
        "pie_labels" => ['大学生(60%)','一般(20%)','高校生(10%)','ファミリー(5%)','その他(5%)'],
        "pie_data" => [60, 20, 10, 5, 5],
        "pie2_labels" => ["男性(50%)", "女性(40%)", "その他(10%)"],
        "pie2_data" => [50, 40, 10],
        "chip_title" => ['plan1', 'plan2', 'plan3'],
        "chip_title2" => ['￥0,000', '￥0,000', '￥0,000'],
        "chip_title3" => ['協賛タイトル', '協賛タイトル', '協賛タイトル'],
        "chip_body" => ['協賛内容', '協賛内容', '協賛内容'],
        "items" => [
            [
                "id" => 1,
                "title" => "お申し込み",
                "text" => "◯月◯日までに下記お問い合わせ先までお申し込みください。",
                "color" => "green-darken-4",
                "colorText" => "green",
            ],
            [
                "id" => 2,
                "title" => "広告データ入稿",
                "text" => "◯月◯日までにパンフレットに掲載する広告データを入稿してください。",
                "color" => "green-darken-4",
                "colorText" => "green",
            ],
            [
                "id" => 3,
                "title" => "大学祭当日",
                "text" => "◯月◯日～◯月◯日来場者に御社の広告が掲載された\nパンフレットを配布いたします",
                "color" => "cyan-darken-4",
                "colorText" => "cyan",
            ],
            [
                "id" => 4,
                "title" => "実施報告",
                "text" => "大学祭の報告書をお送りします。本年度の来場者数などご確認いただけます。",
                "color" => "green-darken-4",
                "colorText" => "green",
            ],
            [
                "id" => 5,
                "title" => "協賛金お支払い",
                "text" => "◯月◯日までに請求書をお送りします。\n期日までにお支払いお願いいたします。",
                "color" => "green-darken-4",
                "colorText" => "green",
            ],
        ],
        "tables" => [
            [ "title" => "項目1", "value" => "￥000,000" ],
            [ "title" => "項目2", "value" => "￥000,000" ],
            [ "title" => "項目3", "value" => "￥000,000" ],
            [ "title" => "項目4", "value" => "￥000,000" ],
            [ "title" => "項目5", "value" => "￥000,000" ],
            [ "title" => "項目6", "value" => "￥000,000" ],
            [ "title" => "項目7", "value" => "￥000,000" ],
            [ "title" => "項目8", "value" => "￥000,000" ],
            [ "title" => "項目9", "value" => "￥000,000" ],
            [ "title" => "項目10", "value" => "￥000,000" ],
            [ "title" => "項目11", "value" => "￥000,000" ],
            [ "title" => "項目12", "value" => "￥000,000" ],
        ],
        "comments" => [
            [
                "id" => 1,
                "icon" => "https://cdn.vuetifyjs.com/images/lists/3.jpg",
                "title" => "株式会社〇〇〇〇",
                "value" => "コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント",
            ],
            [
                "id" => 2,
                "icon" => "https://cdn.vuetifyjs.com/images/lists/3.jpg",
                "title" => "株式会社〇〇〇〇",
                "value" => "コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント",
            ],
            [
                "id" => 3,
                "icon" => "https://cdn.vuetifyjs.com/images/lists/3.jpg",
                "title" => "株式会社〇〇〇〇",
                "value" => "コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント",
            ],
        ],
        "sns" => [
            [
                "key" => "x",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/x.png",
            ],
            [
                "key" => "insta",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/insta.png",
            ],
            [
                "key" => "facebook",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/facebook.png",
            ],
            [
                "key" => "youtube",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/youtube.png",
            ],
            [
                "key" => "n",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/n.png",
            ],
            [
                "key" => "tiktok",
                "flag" => true,
                "url" => "http://yahoo.com",
                "image" => "/default/template1/tiktok.png",
            ],
        ],
    ];
}
