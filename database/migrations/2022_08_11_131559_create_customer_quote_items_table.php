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
        Schema::create('customer_quote_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->bigInteger('customer_quote_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('usd_cents')->nullable();
            $table->integer('zwl_cents')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('variation')->nullable();
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
        Schema::dropIfExists('customer_quote_items');
    }
};
