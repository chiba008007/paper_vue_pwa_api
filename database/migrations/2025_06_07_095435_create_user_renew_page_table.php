<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_renew_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('registed_id');

            // section flags
            $table->boolean('section1')->default(false);
            $table->boolean('section2')->default(false);
            $table->boolean('section3')->default(false);
            $table->boolean('section4')->default(false);
            $table->boolean('section5')->default(false);
            $table->boolean('section6')->default(false);

            // images
            $table->string('top')->nullable();
            $table->boolean('updateTopImage_checked')->default(false)->nullable();
            $table->string('human')->nullable();
            $table->boolean('humanImage_checked')->default(false)->nullable();
            $table->string('ya_image')->nullable();
            $table->string('title1_image')->nullable();
            $table->boolean('title1_image_checked')->default(false)->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->boolean('image1_checked')->default(false)->nullable();
            $table->boolean('image2_checked')->default(false)->nullable();
            $table->boolean('image3_checked')->default(false)->nullable();
            $table->boolean('image4_checked')->default(false)->nullable();
            $table->boolean('image5_checked')->default(false)->nullable();


            // text fields
            $table->string('text1')->nullable();
            $table->string('text2')->nullable();
            $table->string('text3')->nullable();
            $table->string('text4')->nullable();
            $table->string('name')->nullable();
            $table->string('kana')->nullable();
            $table->string('mail')->nullable();
            $table->string('title1')->nullable();
            $table->string('text5')->nullable();
            $table->string('text6')->nullable();
            $table->string('text7')->nullable();
            $table->string('text8')->nullable();
            $table->string('text9')->nullable();
            $table->string('text10')->nullable();
            $table->string('text11')->nullable();
            $table->string('text12')->nullable();
            $table->string('text13')->nullable();
            $table->string('text14')->nullable();
            $table->string('text15')->nullable();
            $table->string('text16')->nullable();
            $table->string('text17')->nullable();
            $table->string('text18')->nullable();
            $table->string('text19')->nullable();
            $table->string('text20')->nullable();
            $table->string('text21')->nullable();
            $table->string('text22')->nullable();
            $table->string('text23')->nullable();
            $table->text('textarea1')->nullable();
            $table->string('text24')->nullable();
            $table->string('text25')->nullable();
            $table->string('charttitle')->nullable();

            $table->string('pietitle1')->nullable();
            $table->string('pietitle2')->nullable();
            $table->text('textarea2')->nullable();
            $table->string('title2')->nullable();
            $table->string('button_label')->nullable();
            $table->string('button_link')->nullable();
            $table->string('button_text')->nullable();
            $table->string('title3')->nullable();
            $table->string('title4')->nullable();
            $table->string('text26')->nullable();
            $table->string('money')->nullable();
            $table->string('text27')->nullable();
            $table->string('title5')->nullable();
            $table->string('title6')->nullable();
            $table->string('text28')->nullable();
            $table->string('contact_mail')->nullable();
            $table->string('contact_tel')->nullable();

            // chart and pie data（固定数）
            $table->json('chart_labels')->nullable();   // 例: ["2021", "2022", ...]
            $table->json('chart_data')->nullable();     // 例: [8000, 9000, ...]
            $table->json('pie_labels')->nullable();   // 例: ["2021", "2022", ...]
            $table->json('pie_data')->nullable();     // 例: [8000, 9000, ...]
            $table->json('pie2_labels')->nullable();   // 例: ["2021", "2022", ...]
            $table->json('pie2_data')->nullable();     // 例: [8000, 9000, ...]

            // 固定配列系（chip、tables、items、comments、sns など）
            $table->json('chip_title')->nullable();
            $table->json('chip_title2')->nullable();
            $table->json('chip_title3')->nullable();
            $table->json('chip_body')->nullable();
            $table->json('items')->nullable();
            $table->json('tables')->nullable();
            $table->json('comments')->nullable();
            $table->json('sns')->nullable();

            // カラー設定
            //$table->json('colors')->nullable();

            $table->timestamps();

            // 外部キー制約（必要に応じて）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_renew_pages');
    }
};
