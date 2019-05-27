<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');

            $table->integer('country_id');
            $table->integer('university_id');
            $table->integer('shirt_id');
            $table->integer('degree_id');
            $table->text('image')->nullable(); // Will be stored as base64

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('SET NULL')->onUpdate('cascade');

            $table->string('email')->unique();
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
}