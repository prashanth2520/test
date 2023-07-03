<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Titlepositions;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class AddTypeToTitilePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $data = DB::table('titlepositions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       
        $newArray = ['Admin','Asst.Manager', 'Contractor','Coordinator', 'Crane Operator', 'Dispatch', 'Field', 'Forklift', 'HSE', 'HSE Advisor', 'office MGR','Shop'];


        $oldArray = ['HSE / Safety','Safety OPS','Truck Pusher','Driver','Swamper','Rigger','Crane Operator','Forklift Operator','Field Superintendent','Rig Manager','Tool Pusher','DSM/Drill Site Manager','Shop / Mechanic','Manager','Other'];

        foreach($oldArray as $values){
            Titlepositions::create(['caption'  => $values,'type' => 2]);
            
         }

        foreach($newArray as $values){
           Titlepositions::create(['caption'  => $values,'type' => 1]);
        }

    }
}
