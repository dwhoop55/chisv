<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceSv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_sv', function (Blueprint $table) {
            $table->integer('conference_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->primary(['conference_id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('conference_id')->references('id')->on('conferences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conference_sv');
    }
}
