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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('name_kh')->nullable();
            $table->string('isbn')->nullable();
            $table->string('barcode')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->string('doi')->nullable();
            $table->string('inventory_number')->nullable();
            $table->date('published_date')->nullable();
            $table->integer('pages_count')->nullable();
            $table->integer('edition')->nullable();
            $table->string('link')->nullable();
            $table->text('short_description')->nullable();
            $table->text('short_description_kh')->nullable();
            $table->text('description')->nullable();
            $table->text('description_kh')->nullable();
            $table->string('keywords', 5000)->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();

            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('publisher_id')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('journal_type_id')->nullable();
            $table->bigInteger('journal_category_id')->nullable();
            $table->bigInteger('journal_sub_category_id')->nullable();
            $table->bigInteger('create_by_user_id')->nullable();
            $table->integer('read_count')->nullable();
            $table->integer('download_count')->nullable();

            $table->integer('status')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
