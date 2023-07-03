<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToDirectionForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->string('new_location_from_old_location')->nullable()->change();
            $table->string('new_location')->nullable()->change();
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
            $table->string('new_location_from_old_location')->nullable(false)->change();
            $table->string('new_location')->nullable(false)->change();
        });
    }
}
