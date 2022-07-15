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
        Schema::create('payment_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('details_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('paynowreference')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('pollurl')->nullable();
            $table->text('hash')->nullable();
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
        Schema::dropIfExists('payment_results');
    }
};
