<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MoveType;

class MoveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        MoveType::truncate();
        $data = [
            ['name' => 'In-Field'],
            ['name' => 'Outfield'],
            ['name' => 'Rig Walk'],
            ['name' => '24 Hour +-']
        ];
        MoveType::insert($data);
    }
}
