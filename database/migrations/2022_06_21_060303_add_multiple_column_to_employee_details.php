<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnToEmployeeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->unsignedBigInteger('jobgroup_id')->after('emp_id')->nullable();
            $table->foreign('jobgroup_id')->references('id')->on('jobgroups')->onDelete('cascade');
            $table->unsignedBigInteger('titleposition_id')->after('jobgroup_id')->nullable();
            $table->foreign('titleposition_id')->references('id')->on('titlepositions')->onDelete('cascade');
            $table->unsignedBigInteger('region_id')->after('titleposition_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
			$table->dropColumn('region_id');
            $table->dropForeign(['titleposition_id']);
			$table->dropColumn('titleposition_id');
            $table->dropForeign(['jobgroup_id']);
			$table->dropColumn('jobgroup_id');
        });
    }
}
