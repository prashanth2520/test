<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('group', function (Blueprint $table) {   
            $table->unsignedBigInteger('created_by')->nullable()->change(); 
            $table->unsignedBigInteger('individual_user_id')->nullable();
            $table->foreign('individual_user_id')->references('id')->on('individuals')->onDelete('cascade');
        });
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group', function (Blueprint $table) {
            $table->dropForeign(['individual_user_id']);
            $table->dropColumn('individual_user_id');            
            $table->unsignedBigInteger('created_by')->nullable(false)->change(); 
        });
    }
}
