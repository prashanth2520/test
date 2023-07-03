<?php

namespace Database\Seeders;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::insert(array(
            array(
                'role' => 'Admin',
            ),
            array(
                'role' => 'Employee',
            )
        ));
    }
}
