<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMoveTypeInRouteAssessmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_assessment_forms', function (Blueprint $table) {
            $table->dropColumn('move_type');
            $table->unsignedBigInteger('move_type_id')->nullable()->after('afe_no');
            $table->foreign('move_type_id')->references('id')->on('move_type');
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
            $table->dropForeign(['move_type_id']);
            $table->dropColumn('move_type_id');
            $table->string('move_type')->nullable()->after('afe_no');
        });
    }
}
