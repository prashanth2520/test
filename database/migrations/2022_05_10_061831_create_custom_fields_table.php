<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id')->references('id')->on('direction_forms')->onDelete('cascade');
            $table->unsignedBigInteger('route_assessment_id')->nullable();
            $table->foreign('route_assessment_id')->references('id')->on('route_assessment_forms')->onDelete('cascade');
            $table->unsignedBigInteger('input_type');
            $table->foreign('input_type')->references('id')->on('input_types')->onDelete('cascade');
            $table->string('label');
            $table->string('value');
            $table->integer('sortorder')->default(0);
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
        Schema::dropIfExists('custom_fields');
    }
}
