<?php

namespace Database\Seeders;
use App\Models\Titlepositions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitlepositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Titlepositions::count() == 0){
        Titlepositions::insert(array(
            array(
                'caption' => 'HSE / Safety',
            ),
            array(
                'caption' => 'Safety OPS',
            ),
            array(
                'caption' => 'Truck Pusher',
            ),
            array(
                'caption' => 'Driver',
            ),
            array(
                'caption' => 'Swamper',
            ),
            array(
                'caption' => 'Rigger',
            ),
            array(
                'caption' => 'Crane Operator',
            ),
            array(
                'caption' => 'Forklift Operator',
            ),
            array(
                'caption' => 'Field Superintendent',
            ),
            array(
                'caption' => 'Rig Manager',
            ),
            array(
                'caption' => 'Tool Pusher',
            ),
            array(
                'caption' => 'DSM/Drill Site Manager',
            ),
            array(
                'caption' => 'Shop / Mechanic',
            ),
            array(
                'caption' => 'Manager',
            ),
            array(
                'caption' => 'Other',
            )
        ));

    }
    }
}