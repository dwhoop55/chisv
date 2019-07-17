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

            $table->integer('city_id');
            $table->integer('university_id')->nullable();
            $table->string('university_fallback')->nullable()->default(null);
            $table->integer('shirt_id');
            $table->integer('degree_id')->nullable();

            $table->string('past_conferences')->nullable()->default(null);
            $table->string('past_conferences_sv')->nullable()->default(null);

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('SET NULL')->onUpdate('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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