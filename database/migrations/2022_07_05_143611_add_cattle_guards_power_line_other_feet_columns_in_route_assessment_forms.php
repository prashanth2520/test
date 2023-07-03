<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCattleGuardsPowerLineOtherFeetColumnsInRouteAssessmentForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->string('begindirections_cattle_guards')->after('total_miles')->nullable();
            $table->string('begindirections_power_line')->after('begindirections_cattle_guards')->nullable();
            $table->string('begindirections_other')->after('begindirections_power_line')->nullable();
            $table->string('begindirections_feet')->after('begindirections_other')->nullable();
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
            $table->dropColumn('begindirections_feet');
            $table->dropColumn('begindirections_other');
            $table->dropColumn('begindirections_power_line');
            $table->dropColumn('begindirections_cattle_guards');
        });
    }
}
