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
            $table->unsignedInteger('creator_id')->nullable();
            $table->unsignedInteger('state_id')->nullable(false)->default(21);
            $table->string('handler')->nullable(false);
            $table->string('payload')->nullable(true);
            $table->string('result')->nullable(true);
            $table->timestamp('start_at')->nullable(false)->useCurrent();
            $table->timestamp('ended_at')->nullable(true);
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