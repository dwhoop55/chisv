<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterConferencesAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->unsignedTinyInteger('volunteer_hours')->default(20)->nullable(false);
            $table->unsignedTinyInteger('volunteer_max')->default(100)->nullable(false);
            $table->string('email_chair')->default('noreply@chisv.org');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->dropColumn('volunteer_hours');
            $table->dropColumn('volunteer_max');
            $table->dropColumn('email_chair');
        });
    }
}