<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelAndLabelNameToRouteDirections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_directions', function (Blueprint $table) {
            $table->string('label')->nullable()->after('new_location');
            $table->string('labelName')->nullable()->after('label');
            
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
            $table->dropColumn(['labelName', 'label']);
        });
    }
}
