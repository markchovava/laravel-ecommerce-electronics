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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->text('sku')->nullable();
            $table->text('status')->nullable();
            $table->text('type')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->longText('serialnumber')->nullable();
            $table->longText('qrcode')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('zwl_price')->nullable();
            $table->text('physical_delivery')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
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
        Schema::dropIfExists('products');
    }
};
