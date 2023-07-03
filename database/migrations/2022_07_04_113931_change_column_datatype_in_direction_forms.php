<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnDatatypeInDirectionForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->text('old_location_steps')->change();
            $table->text('new_location_from_old_location_steps')->change();
            $table->text('new_location_steps')->change();
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
            $table->string('new_location_steps')->change();
            $table->string('new_location_from_old_location_steps')->change();
            $table->string('old_location_steps')->change();
        });
    }
}
