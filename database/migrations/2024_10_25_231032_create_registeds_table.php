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
        Schema::create('registeds', function (Blueprint $table) {
            $table->id();
            $table->string('code',512)->unique();
            $table->string('name');
            $table->string('mail');
            $table->string('tel');
            $table->string('post');
            $table->string('pref');
            $table->string('address',1280);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registeds');
    }
};
