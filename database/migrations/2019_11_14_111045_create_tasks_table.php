<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('conference_id')->index();
            $table->string('name')->nullable(false)->index();
            $table->text('description')->nullable();
            $table->string('location')->nullable()->index();
            $table->date('date')->index();
            $table->time('start_at')->nullable()->index();
            $table->time('end_at')->nullable()->index();
            $table->unsignedInteger('priority')->index()->default(0);
            $table->unsignedInteger('slots');
            $table->double('hours')->nullable();

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
        Schema::dropIfExists('tasks');
    }
}