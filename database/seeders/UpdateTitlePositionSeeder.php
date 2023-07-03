<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Titlepositions;

class UpdateTitlePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newArray = ['Admin','Asst.Manager', 'Contractor','Coordinator', 'Crane Operator', 'Dispatch', 'Field', 'Forklift', 'HSE', 'HSE Advisor', 'office MGR','Shop'];

        $oldArray = ['Truck Pusher', 'Driver', 'Swamper','Rigger', 'Crane Operator','Forklift Operator','Field','Superintendent' ,'Rig Manager','Tool Pusher','DSM/Drill Site Manager','Shop / Mechanic','Manager','Other'];

        $diffValues = array_diff($newArray, $oldArray);
        foreach($diffValues as $values){
            Titlepositions::create(['caption' => $values]);
        }

    }
}
