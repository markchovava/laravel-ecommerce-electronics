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
        Schema::create('customer_quote_order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('customer_quote_order_id')->nullable();
            $table->string('product_name')->nullable();
            $table->text('product_variation')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('zwl_unit_price')->nullable();
            $table->bigInteger('product_total')->nullable();
            $table->bigInteger('product_zwl_total')->nullable();
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
        Schema::dropIfExists('customer_quote_order_items');
    }
};
