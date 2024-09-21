<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tel')->nullable();
            $table->string('post')->nullable();
            $table->string('pref')->nullable();
            $table->string('address',1280)->nullable();
            $table->string('display_name')->nullable();
            $table->string('syozoku')->nullable();
            $table->string('kana')->nullable();
            $table->text('myimage_path')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_image_path')->nullable();
            $table->string('company_url')->nullable();
            $table->text('profile')->nullable();
            $table->integer('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
