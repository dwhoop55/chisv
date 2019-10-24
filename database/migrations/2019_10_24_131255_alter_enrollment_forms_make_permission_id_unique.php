<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnrollmentFormsMakePermissionIdUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_forms', function (Blueprint $table) {
            $table->unique('permission_id', 'uniq_permission_id');
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
            $table->dropUnique('uniq_permission_id');
        });
    }
}