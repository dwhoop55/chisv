<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('handler');
            $table->json('result')->nullable();
            $table->json('payload')->nullable();
            $table->integer('progress')->nullable();
            $table->string('status_message')->nullable();
            $table->unsignedInteger('state_id')->nullable(false)->default(21);
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('start_at')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}