<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_froms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->dateTime('date_time');
            $table->string('temp')->nullable();
            $table->string('operator')->nullable();
            $table->string('rig')->nullable();
            $table->string('company_man')->nullable();
            $table->string('company_man_email')->nullable();
            $table->string('old_location')->nullable();
            $table->string('old_gps_coordinates')->nullable();
            $table->string('old_emergency')->nullable();
            $table->string('old_closest_emergency_room')->nullable();
            $table->string('new_location')->nullable();
            $table->string('new_gps_coordinates')->nullable();
            $table->string('new_emergency')->nullable();
            $table->string('new_closest_emergency_room')->nullable();
            $table->string('direction_new_location')->nullable();
            $table->string('total_miles')->nullable();
            $table->string('total_cattle_gaurds')->nullable();
            $table->string('total_overhead_harzards')->nullable();
            $table->string('lowest_overhead_harzards')->nullable();
            $table->string('total_power_lines')->nullable();
            $table->string('lowest_power_lines')->nullable();
            $table->string('hazards_on_routes')->nullable();
            $table->string('goalpost_height')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_froms');
    }
}
