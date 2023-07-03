<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteAssessmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_assessment_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
            $table->dateTime('date_time');
            // $table->string('job_no');
            $table->string('temperature')->nullable();
            $table->string('route_assessment')->nullable();
            // $table->string('rig_name');
            // $table->string('rig_no')->nullable();
            $table->string('rig_type')->nullable();
            $table->string('rig_manager')->nullable();
            $table->string('rig_phone')->nullable();
            $table->string('rig_email')->nullable();
            $table->string('afe_no')->nullable();
            $table->string('move_type')->nullable();
            $table->string('est_miles')->nullable();
            $table->string('operator')->nullable();
            $table->string('operator_email')->nullable();
            $table->string('operator_dms')->nullable();
            $table->string('old_location');
            $table->string('old_gps_coordinates');
            $table->string('old_emergency')->nullable();
            $table->string('old_closest_emergency_room')->nullable();
            $table->string('new_location');
            $table->string('new_gps_coordinates');
            $table->string('new_emergency')->nullable();
            $table->string('new_closest_emergency_room')->nullable();
            $table->text('direction_new_location');
            $table->string('total_miles')->nullable();
            $table->string('total_cattle_gaurds')->nullable();
            $table->string('total_overhead_harzards')->nullable();
            $table->string('lowest_overhead_harzards')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_assessment_forms');
    }
}
