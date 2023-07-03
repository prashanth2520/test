<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRigTypeInRouteAssessmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->dropColumn('rig_type');
            $table->unsignedBigInteger('rig_type_id')->nullable()->after('rig_email');
            $table->foreign('rig_type_id')->references('id')->on('rig_type');
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
            $table->dropForeign(['rig_type_id']);
            $table->dropColumn('rig_type_id');
            $table->string('rig_type')->nullable()->after('route_assessment');
        });
    }
}
