<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPermissionAddEnrollmentFormsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('enrollment_form_id', false, true)->after('state_id')->unsigned()->unique()->index()->nullable()->comment('Some roles may have an enrollment form');
            $table->unique(['user_id', 'role_id', 'conference_id'], 'uniq_user_role_conference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('enrollment_form_id');
            $table->dropUnique('uniq_user_role_conference');
        });
    }
}