<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('permission_id')->index();
            $table->boolean('know_city')->index();
            $table->boolean('attend_before')->index();
            $table->boolean('sved_before')->index();
            $table->boolean('need_visa')->index();
            $table->text('why');
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
        Schema::dropIfExists('enrollment_infos');
    }
}