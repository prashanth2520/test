<?php

namespace Database\Seeders;

use App\Models\Hazard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HazardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Hazard::truncate();
        $data = [
            ['name' => 'No Hazard'],
            ['name' => 'Cattle Guard'],
            ['name' => 'Power Line'],
            ['name' => 'Uneven Rough Road'],
            ['name' => 'Livestock'],
            ['name' => 'Railroad Tracks'],
            ['name' => 'Low Overpass'],
            ['name' => 'Flare System'],
            ['name' => 'Electric Unites'],
            ['name' => 'Unground Gas Lines'],
            ['name' => 'Other Hazard'],
           
        ];

        Hazard::insert($data);
    }
}
