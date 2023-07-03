<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direction_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
            $table->string('old_location');
            $table->string('old_location_steps')->nullable();
            $table->string('new_location_from_old_location');
            $table->string('new_location_from_old_location_steps')->nullable();
            $table->string('new_location');
            $table->string('new_location_steps')->nullable();
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
        Schema::dropIfExists('direction_forms');
    }
}
