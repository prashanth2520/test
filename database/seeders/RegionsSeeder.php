<?php

namespace Database\Seeders;
use App\Models\Regions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Regions::count() == 0){
        Regions::insert(array(
            array(
                'caption' => 'Permian - West Texas',
            ),
            array(
                'caption' => 'Eagle Ford - South Texas',
            ),
            array(
                'caption' => 'Barnett - South Texas',
            ),
            array(
                'caption' => 'Haynesville - LA/AR',
            ),
            array(
                'caption' => 'Granite Wash - TX/OK',
            ),
            array(
                'caption' => 'Anadarko-Woodford -West Central OK',
            ),
            array(
                'caption' => 'Bakken - MT-ND',
            ),
            array(
                'caption' => 'Marcellus - NY-PA-OH-WV-TN-VA',
            ),
            array(
                'caption' => 'Utica - NY-PA-OH-WV',
            ),
            array(
                'caption' => 'Production',
            ),
            array(
                'caption' => 'Corporate',
            ),
            array(
                'caption' => 'Other',
            )
        ));

    }
    }
}