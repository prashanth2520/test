<?php

namespace Database\Seeders;

use App\Models\RigStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class RigStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        RigStatus::truncate();
        $data = [
            ['name' => 'Active'],
            ['name' => 'Scheduled'],
            ['name' => 'In-Progress'],
            ['name' => 'Completed'],
            ['name' => 'Staged'],
            ['name' => 'Cancelled']
        ];
        RigStatus::insert($data);

    }
}
