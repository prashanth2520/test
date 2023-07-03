<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddmultipleCattleGuardsPowerLineOtherFeetColumnsInDirectionForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direction_forms', function (Blueprint $table) {
            $table->double('oldlocation_cattle_guards')->after('old_location_steps')->nullable();
            $table->double('oldlocation_power_line')->after('oldlocation_cattle_guards')->nullable();
            $table->double('oldlocation_other')->after('oldlocation_power_line')->nullable();
            $table->double('oldlocation_feet')->after('oldlocation_other')->nullable();
            $table->double('newlocation_cattle_guards')->after('new_location_from_old_location_steps')->nullable();
            $table->double('newlocation_power_line')->after('newlocation_cattle_guards')->nullable();
            $table->double('newlocation_other')->after('newlocation_power_line')->nullable();
            $table->double('newlocation_feet')->after('newlocation_other')->nullable();
            $table->double('direction_to_newlocation_cattle_guards')->after('new_location_steps')->nullable();
            $table->double('direction_to_newlocation_power_line')->after('direction_to_newlocation_cattle_guards')->nullable();
            $table->double('direction_to_newlocation_other')->after('direction_to_newlocation_power_line')->nullable();
            $table->double('direction_to_newlocation_feet')->after('direction_to_newlocation_other')->nullable();
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
            $table->dropColumn('direction_to_newlocation_feet');
            $table->dropColumn('direction_to_newlocation_other');
            $table->dropColumn('direction_to_newlocation_power_line');
            $table->dropColumn('direction_to_newlocation_cattle_guards');
            $table->dropColumn('newlocation_feet');
            $table->dropColumn('newlocation_other');
            $table->dropColumn('newlocation_power_line');
            $table->dropColumn('newlocation_cattle_guards');
            $table->dropColumn('oldlocation_feet');
            $table->dropColumn('oldlocation_other');
            $table->dropColumn('oldlocation_power_line');
            $table->dropColumn('oldlocation_cattle_guards');
        });
    }
}
