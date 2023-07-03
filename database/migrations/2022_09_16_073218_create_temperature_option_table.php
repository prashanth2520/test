<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperatureOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperature_option', function (Blueprint $table) {
              $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('route_assessment_forms_id');
            $table->foreign('route_assessment_forms_id')->references('id')->on('route_assessment_forms');
            $table->unsignedBigInteger('temperature_id');
            $table->foreign('temperature_id')->references('id')->on('temperature');
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
        Schema::dropIfExists('temperature_option');
    }
}
