<?php

namespace Database\Seeders;
use App\Models\Measurement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MeasurementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Measurement::truncate();
        $data = [
            ['name' => 'Miles'],
            ['name' => 'Feet'],
            ['name' => 'Yards'], 
        ];
        Measurement::insert($data);
    }
}
