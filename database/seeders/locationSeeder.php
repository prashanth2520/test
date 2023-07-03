<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class locationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Location::count() == 0) {
            $locationArray = ['Eagle Ford','Bakken', 'Marcellus', 'Utica', 'Haynesville','Niobrara','Barnett', 'Woodford','Fayetteville', 'Permian Basin'];

            if(Location::count() == 0){
                foreach($locationArray as $location){
                    Location::create([
                        'location' =>  $location
                    ]);
                }
            }

        }
    }
}
