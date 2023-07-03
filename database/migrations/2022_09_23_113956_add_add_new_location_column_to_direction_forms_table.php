<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddNewLocationColumnToDirectionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->string('add_new_location')->after('old_location');
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
            $table->dropColumn('add_new_location');
        });
    }
}
