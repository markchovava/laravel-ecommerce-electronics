<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('click_name')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('amount')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stickers');
    }
};
