<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_user_id')->nullable();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('description_kh')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->decimal('vat_percent', 5, 2)->nullable()->default(0);
            $table->decimal('exchange_rate_riel', 10, 2)->default(4100);
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
