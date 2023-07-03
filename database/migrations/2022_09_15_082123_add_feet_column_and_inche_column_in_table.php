<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeetColumnAndIncheColumnInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->integer('goal_post_feet')->nullable()->after('new_closest_emergency_room');
            $table->integer('goal_post_inches')->nullable()->after('goal_post_feet');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->dropColumn(['goal_post_feet','goal_post_inches']);
        });
    }
}
