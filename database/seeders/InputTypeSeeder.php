<?php

namespace Database\Seeders;
use App\Models\InputType;
use Illuminate\Database\Seeder;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(InputType::count() == 0){
            InputType::insert(array(
                array(
                    'type_name' => 'text'
                ),
                array(
                    'type_name' => 'number'
                ),
                array(
                    'type_name' => 'textarea'
                ),
                array(
                    'type_name' => 'select'
                ),
                array(
                    'type_name' => 'multiselect'
                )
            ));
        }
        
    }
}
