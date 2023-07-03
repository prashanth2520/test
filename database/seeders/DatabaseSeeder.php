<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InputTypeSeeder::class);
        $this->call(RecordTypeSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(Userseeder::class);
        $this->call(JobgroupsSeeder::class);
        $this->call(TitlepositionsSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(RigTypeSeeder::class);
        $this->call(MoveTypeSeeder::class);
        $this->call(RigStatusSeeder::class);
        $this->call(TemperatureSeeder::class);
    }
}
