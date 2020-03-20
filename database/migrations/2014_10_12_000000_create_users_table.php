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
            $table->integer('region_id');
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
            $table->integer('timezone_id')->default(291); // This is UTC/ETC
            $table->integer('locale_id')->default(40); // This is en_US
            $table->rememberToken();

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