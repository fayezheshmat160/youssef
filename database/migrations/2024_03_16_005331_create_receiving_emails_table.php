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
        Schema::create('receiving_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            // // Relation
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->foreign('created_by')->references('id')->on($this->adminTable())->onDelete("set null")->onUpdate('cascade');

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
        Schema::dropIfExists('receiving_emails');
    }
};
