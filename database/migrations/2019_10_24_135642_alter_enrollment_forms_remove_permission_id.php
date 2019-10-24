<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnrollmentFormsRemovePermissionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_forms', function (Blueprint $table) {
            $table->dropColumn('permission_id');
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
            $table->bigInteger('permission_id', false, true)->nullable()->index()->unique();
        });
    }
}