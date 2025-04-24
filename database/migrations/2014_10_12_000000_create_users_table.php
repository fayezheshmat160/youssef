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
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password', 150);

            $table->string('avatar', 100)->nullable();
            $table->string('phone', 75)->nullable();
            $table->enum('status', [1, 0])->default(1)->comment("If the account is banned, the value will be 0");
            $table->timestamp('last_seen')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->enum('role', ['admin', 'student'])->default('student');
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
