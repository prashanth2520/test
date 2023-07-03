<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupListIdToGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->after('phone')->nullable();
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade'); 
            $table->unsignedBigInteger('group_id')->after('location_id')->nullable();
            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade'); 
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
            $table->dropForeign('employee_details_group_id_foreign');
            $table->dropColumn('group_id');
            $table->dropForeign('employee_details_location_id_foreign');
            $table->dropColumn('location_id');
        });

      
    }
}
