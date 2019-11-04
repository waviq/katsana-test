<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TripAndPositinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('distance');
            $table->unsignedBigInteger('duration');
            $table->double('max_speed');
            $table->double('average_speed');
            $table->unsignedBigInteger('idle_duration');
            $table->unsignedInteger('score');
            $table->json('start');
            $table->json('end');
            $table->softDeletes();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trip_id')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamp('tracked_at')->nullable();
            $table->double('speed');
            $table->unsignedBigInteger('voltage');
            $table->unsignedBigInteger('distance');
            $table->softDeletes();

            $table->foreign('trip_id')->references('id')
                ->on('trips')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('positions', function (Blueprint $table) {
           $table->dropForeign('positions_trip_id_foreign');
        });
        Schema::dropIfExists('trips');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('trip_starts');
        Schema::dropIfExists('trip_ends');
    }
}
