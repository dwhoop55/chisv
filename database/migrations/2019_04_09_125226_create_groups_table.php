<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index('idx_name')->unique();
            $table->string('description')->nullable();
        });

        $groups = [
            ['id' => 1, 'name' => 'global_admin', 'description' => 'Has all rights'],
            ['id' => 2, 'name' => 'conference_admin', 'description' => 'Has rights to manage one or more specific conferences'],
            ['id' => 3, 'name' => 'student', 'description' => 'Can enroll for conferences as student Voluneer'],

        ];

        DB::table('groups')->insert($groups);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}