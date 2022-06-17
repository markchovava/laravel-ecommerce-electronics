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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('quote_number')->nullable();
            $table->string('billing_name')->nullable();
            $table->longText('billing_address')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('subtotal_cents')->nullable();
            $table->integer('zw_subtotal_cents')->nullable();
            $table->integer('grandtotal_cents')->nullable();
            $table->integer('zw_grandtotal_cents')->nullable();
            $table->longText('notes')->nullable();
            $table->string('quote_date')->nullable();
            $table->string('quote_due_date')->nullable();
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
        Schema::dropIfExists('quotes');
    }
};
