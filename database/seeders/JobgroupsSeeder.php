<?php

namespace Database\Seeders;
use App\Models\Jobgroups;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobgroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Jobgroups::count() == 0){
        Jobgroups::insert(array(
            array(
                'caption' => 'Transportation/Trucking',
            ),
            array(
                'caption' => 'Drilling Rig',
            ),
            array(
                'caption' => 'Rig Operator',
            ),
            array(
                'caption' => 'Maintenance/Shop',
            ),
            array(
                'caption' => '3rd Party Contractor',
            ),
            array(
                'caption' => 'Other',
            )
        ));
    }
    }
}