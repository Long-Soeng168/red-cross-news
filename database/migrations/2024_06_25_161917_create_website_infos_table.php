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
        Schema::create('website_infos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('name_kh')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('primary')->nullable();
            $table->string('primary_hover')->nullable();
            $table->string('banner_color')->nullable();
            $table->boolean('show_bg_menu')->default(true);
            $table->boolean('pdf_viewer_default')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_infos');
    }
};
