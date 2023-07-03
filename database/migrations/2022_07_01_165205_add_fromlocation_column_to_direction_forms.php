<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromlocationColumnToDirectionForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->string('from_location')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->string('from_location')->after('id')->nullable();
        });
    }
}
