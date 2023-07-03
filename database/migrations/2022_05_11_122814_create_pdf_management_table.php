<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id')->references('id')->on('direction_forms')->onDelete('cascade');
            $table->unsignedBigInteger('route_assessment_id')->nullable();
            $table->foreign('route_assessment_id')->references('id')->on('route_assessment_forms')->onDelete('cascade');
            $table->string('file_path');
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
        Schema::dropIfExists('pdf_management');
    }
}
