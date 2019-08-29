<?php

use App\State;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('key', 30)->unique()->index();
            $table->string('location', 100)->nullable()->default(null);
            $table->integer('timezone_id')->nullable()->default(null);
            $table->date('start_date')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('enrollment_info')->nullable()->default(null);
            $table->integer('state_id')->default(1);
            $table->integer('enable_bidding')->default(0);
            $table->string('url', 300)->nullable()->default('https://www.acm.org/');
            $table->string('url_name', 100)->nullable()->default("ACM");

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
        Schema::dropIfExists('conferences');
    }
}