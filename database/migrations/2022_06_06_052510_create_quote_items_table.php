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
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quote_id')->nullable();
            $table->text('product_name')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->integer('price_cents')->nullable();
            $table->integer('zw_price_cents')->nullable();
            $table->integer('total_cents')->nullable();
            $table->integer('zw_total_cents')->nullable();
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
        Schema::dropIfExists('quote_items');
    }
};
