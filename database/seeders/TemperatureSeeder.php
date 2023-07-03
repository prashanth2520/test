<?php

namespace Database\Seeders;

use App\Models\Temperature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Temperature::truncate();

        $data=[
            ['name'=>'Hot/Dry'],
            ['name'=>'Sunny/Clear'],
            ['name'=>'Partly Cloudy'],
            ['name'=>'Cloudy'],
            ['name'=>'Overcast'],
            ['name'=>'Windy'],
            ['name'=>'Rain'],
            ['name'=>'Drizzle'],
            ['name'=>'Foggy'],
            ['name'=>'Snow'],
            ['name'=>'Stormy']
        ];
        Temperature::insert($data);
        
    }
}
