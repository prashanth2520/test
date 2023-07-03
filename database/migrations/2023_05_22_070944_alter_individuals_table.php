<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('individuals', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('caption')->nullable()->after('phone');

        });

        Schema::table('users_location_details', function (Blueprint $table) {
            $table->unsignedBigInteger('individual_user_id')->nullable();
            $table->foreign('individual_user_id')->references('id')->on('individuals')->onDelete('cascade'); 
        });

        Schema::table('titlepositions', function (Blueprint $table) {
            $table->integer('type')->after('caption')->nullable()->comment("1 => job-title , 2 => group");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('individuals', function (Blueprint $table) {
            $table->dropColumn('caption');
            $table->dropColumn('phone');         
        });
        Schema::table('users_location_details', function (Blueprint $table) {
            $table->dropColumn(['individual_user_id']);
        });

        Schema::table('titlepositions', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
