<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id', false, true)->nullable()->index();
            $table->string('name')->index()->nullable(false);
            $table->boolean('is_filled')->default(true)->index();
            $table->json('body');

            $table->foreign('permission_id')
                ->references('id')->on('permissions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollment_forms');
    }
}