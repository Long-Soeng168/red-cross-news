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
        Schema::create('audio', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('name_kh')->nullable();
            $table->integer('year')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('keywords', 5000)->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('publisher_id')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('audio_type_id')->nullable();
            $table->bigInteger('audio_category_id')->nullable();
            $table->bigInteger('audio_sub_category_id')->nullable();
            $table->bigInteger('create_by_user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio');
    }
};
