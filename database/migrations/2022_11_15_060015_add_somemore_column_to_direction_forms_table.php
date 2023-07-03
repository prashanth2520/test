<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomemoreColumnToDirectionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->string('latitude')->nullable()->after('from_location');
            $table->string('langitude')->nullable()->after('latitude');
            $table->string('drilling_rig_name')->nullable()->after('langitude');
            $table->string('drilling_rig_no')->nullable()->after('drilling_rig_name');
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
            $table->dropColumn(['drilling_rig_no', 'drilling_rig_name', 'langitude', 'latitude']);
        });
    }
}
