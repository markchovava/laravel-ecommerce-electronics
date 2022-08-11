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
        Schema::create('customer_quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('shopping_session')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('usd_subtotal')->nullable();
            $table->integer('zwl_subtotal')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('usd_grandtotal')->nullable();
            $table->integer('zwl_grandtotal')->nullable();
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
        Schema::dropIfExists('customer_quotes');
    }
};
