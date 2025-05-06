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
        Schema::create('passages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->enum('type', ['لفظي', 'كمي']);
            $table->unsignedBigInteger("subject_id")->nullable();
            $table->foreign("subject_id")->references("id")->on("subjects")->onDelete('cascade');
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
        Schema::dropIfExists('passages');
    }
};
