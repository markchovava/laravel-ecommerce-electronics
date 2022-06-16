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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('id_number')->nullable();
            $table->string('code')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('city')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone_number')->nullable();
            $table->longText('company_address')->nullable();
            $table->string('company_city')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
