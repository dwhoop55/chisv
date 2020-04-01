<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersChangeStringToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('past_conferences')->nullable()->default(null)->change();
            $table->json('past_conferences_sv')->nullable()->default(null)->change();
        });

        // Migrate data
        // string -> json
        $rows = DB::table('users')->get();
        foreach ($rows as $row) {
            $past = preg_replace('/[;,.]/m', ' ', $row->past_conferences);
            $past = preg_replace('!\s+!', ' ', $past);
            $past = explode(' ', $past);
            $past = array_values(array_unique($past));
            $past = array_filter($past); // Will remove empty strings

            $pastSv = preg_replace('/[;,.]/m', ' ', $row->past_conferences_sv);
            $pastSv = preg_replace('!\s+!', ' ', $pastSv);
            $pastSv = explode(' ', $pastSv);
            $pastSv = array_values(array_unique($pastSv));
            $pastSv = array_filter($pastSv); // Will remove empty strings

            DB::table('users')
                ->where('id', $row->id)
                ->update([
                    'past_conferences' => json_encode($past),
                    'past_conferences_sv' => json_encode($pastSv),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('past_conferences')->nullable()->default(null)->change();
            $table->string('past_conferences_sv')->nullable()->default(null)->change();
        });

        // Rollback data
        // json -> string
        $rows = DB::table('users')->get();
        foreach ($rows as $row) {
            DB::table('users')
                ->where('id', $row->id)
                ->update([
                    'past_conferences' => implode(', ', json_decode($row->past_conferences)),
                    'past_conferences_sv' => implode(', ', json_decode($row->past_conferences_sv)),
                ]);
        }
    }
}