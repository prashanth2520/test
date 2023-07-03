<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(array(
            array(
                'name' => 'Rigroutes Admin',
                'email' => 'rigroutes.admin@gmail.com',
                'password' => Hash::make('password'),
                'user_role' => '1'
            )
        ));
    }
}
