<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeMoreColumnsToRouteAssessmentForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->string('lowest_overhead_harzards_feet')->nullable()->after('lowest_overhead_harzards');
            $table->string('lowest_overhead_harzards_inches')->nullable()->after('lowest_overhead_harzards_feet');
            $table->string('lowest_power_line_feet')->nullable()->after('lowest_power_line');
            $table->string('lowest_power_line_inches')->nullable()->after('lowest_power_line_feet');
            $table->string('old_location_latitude')->nullable()->after('old_gps_coordinates');
            $table->string('old_location_longitude')->nullable()->after('old_location_latitude');
            $table->string('new_location_latitude')->nullable()->after('new_gps_coordinates');
            $table->string('new_location_longitude')->nullable()->after('new_location_latitude');
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
            $table->dropColumn(
                [
                    'new_location_longitude',
                    'new_location_latitude',
                    'old_location_longitude',
                    'old_location_latitude',
                    'lowest_power_line_inches',
                    'lowest_power_line_feet',
                    'lowest_overhead_harzards_inches',
                    'lowest_overhead_harzards_feet'
                ]
            );
        });
    }
}
