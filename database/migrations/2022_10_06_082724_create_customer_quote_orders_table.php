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
       
        Schema::create('customer_quote_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('reference_id')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->bigInteger('zwl_subtotal')->nullable();
            $table->string('include_shipping')->nullable();
            $table->bigInteger('shipping_fee')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('zwl_total')->nullable();
            $table->string('status')->nullable();
            $table->string('delivery')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('customer_quote_orders');
    }
};
