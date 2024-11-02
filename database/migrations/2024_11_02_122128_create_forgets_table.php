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
        Schema::create('forgets', function (Blueprint $table) {
            $table->id();
            $table->string("forgetCode",256);
            $table->string("email",256);
            $table->integer('user_id');
            $table->integer('status')->default(1)->comment('1:有効 2:終了');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forgets');
    }
};
