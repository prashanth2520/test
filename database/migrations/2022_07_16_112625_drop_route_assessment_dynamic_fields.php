<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRouteAssessmentDynamicFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->dropColumn(['direction_new_location', 'begindirections_cattle_guards','begindirections_power_line','begindirections_other','begindirections_feet']);
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
            //
        });
    }
}
