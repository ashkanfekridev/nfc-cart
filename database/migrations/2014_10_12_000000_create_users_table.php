<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // user Require data
            $table->string('user_name');
            $table->string('phone_number')->unique();
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            // Farsi user information
            $table->string('fa_first_name')->nullable();
            $table->string('fa_last_name')->nullable();
            $table->text('fa_description')->nullable();
            // English user information
            $table->string('en_first_name')->nullable();
            $table->string('en_last_name')->nullable();
            $table->text('en_description')->nullable();
            $table->enum('type', ['admin', 'user'])->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
