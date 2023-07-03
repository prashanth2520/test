<?php

namespace Database\Seeders;
use App\Models\RecordType;
use Illuminate\Database\Seeder;

class RecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecordType::insert(array(
            array(
                'record_type' => 'Direction',
            ),
            array(
                'record_type' => 'Route Assessment',
            ),
            array(
                'record_type' => 'Both',
            )
        ));
    }
}
