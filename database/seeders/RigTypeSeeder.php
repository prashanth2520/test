<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RigType;

class RigTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        RigType::truncate();
        $data = [
            ['name' => 'Boss'],
            ['name' => 'Apex'],
            ['name' => 'Box-on-Box'],
            ['name' => 'Conventional'],
            ['name' => 'Down-hole'],
            ['name' => 'F-Rig'],
            ['name' => 'Flex 3'],
            ['name' => 'Flex S3'],
            ['name' => 'Flex 3W'],
            ['name' => 'Flex 5'],
            ['name' => 'M Rig'],
            ['name' => 'NOV'],
            ['name' => 'Othercussion'],
            ['name' => 'Rig Style'],
            ['name' => 'Rocket'],
            ['name' => 'Rotary'],
            ['name' => 'S-Rig'],
            ['name' => 'Sling Shot'],
            ['name' => 'Super Single'],
            ['name' => 'Tele-Double'],
            ['name' => 'Triple Box'],
            ['name' => 'Wolfslayer'],
            ['name' => 'Workover'],
            ['name' => 'X Rig']
        ];

        RigType::insert($data);
    }
}
