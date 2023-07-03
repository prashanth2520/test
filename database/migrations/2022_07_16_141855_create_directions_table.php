<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_directions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('record_type_id')->nullable();
            $table->foreign('record_type_id')->references('id')->on('record_type')->onDelete('cascade');
           
            $table->unsignedBigInteger('direction_form_id')->nullable();;
            $table->foreign('direction_form_id')->references('id')->on('direction_forms')->onDelete('cascade');
           
            $table->unsignedBigInteger('route_assessment_form_id')->nullable();;
            $table->foreign('route_assessment_form_id')->references('id')->on('route_assessment_forms')->onDelete('cascade');
           
            $table->string('new_location')->nullable();
            $table->string('cattle_guards')->nullable();
            $table->string('power_line')->nullable();
            $table->string('other')->nullable();
            $table->string('feet')->nullable();

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
        Schema::dropIfExists('route_directions');
    }
}
