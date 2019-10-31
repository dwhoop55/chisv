<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnrollmentFormsAddTotalWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_forms', function (Blueprint $table) {
            $table->integer('total_weight')->after('is_filled')->index()->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrollment_forms', function (Blueprint $table) {
            $table->dropColumn('total_weight');
        });
    }
}