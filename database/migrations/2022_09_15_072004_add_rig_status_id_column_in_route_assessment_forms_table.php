<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRigStatusIdColumnInRouteAssessmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('rig_status_id')->nullable()->after('rig_email');
            $table->foreign('rig_status_id')->references('id')->on('rig_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->dropForeign(['rig_status_id']);
            $table->dropColumn('rig_status_id');
        });
    }
}
