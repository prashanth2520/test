<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHazardFiledsToRouteDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_directions', function (Blueprint $table) {
            $table->string('inches')->nullable()->after('feet');
            $table->string('distance')->nullable()->after('inches');
            $table->unsignedBigInteger('hazard_id')->nullable()->after('distance');
            $table->foreign('hazard_id')->references('id')->on('hazard');
            $table->string('instruction')->nullable()->after('hazard_id');
            $table->string('note')->nullable()->after('instruction');
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
            $table->dropForeign(['hazard_id']);
            $table->dropColumn(['hazard_id','inches','distance','instruction','note']);
        });
    }
}
