<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnToRouteAssesmentForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->string('total_guide_wire')->after('total_overhead_harzards')->nullable();
            $table->string('lowest_power_line')->after('lowest_overhead_harzards')->nullable();
            $table->string('route_assessor_name')->after('lowest_power_line')->nullable();
            $table->string('route_assessor_email')->after('route_assessor_name')->nullable();
            $table->string('route_assessor_phone')->after('route_assessor_email')->nullable();
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
	    $table->dropColumn('route_assessor_phone');
	    $table->dropColumn('route_assessor_email');
	    $table->dropColumn('route_assessor_name');
            $table->dropColumn('lowest_power_line');
            $table->dropColumn('total_guide_wire');
        });
    }
}
