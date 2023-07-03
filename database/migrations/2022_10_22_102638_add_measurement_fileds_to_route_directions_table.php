<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeasurementFiledsToRouteDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_directions', function (Blueprint $table) {
            $table->unsignedBigInteger('measurement_id')->nullable()->after('distance');
            $table->foreign('measurement_id')->references('id')->on('measurement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_directions', function (Blueprint $table) {
            $table->dropForeign(['measurement_id']);
            $table->dropColumn(['measurement_id']);
        });
    }
}
