<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectionForm extends Model
{
    use HasFactory;

    protected $table = 'direction_forms';
    protected $fillable = ['from_location','latitude','langitude','drilling_rig_name','drilling_rig_no','record_id','old_location','add_new_location','old_location_steps','oldlocation_cattle_guards','oldlocation_power_line','oldlocation_other','oldlocation_feet','new_location_from_old_location','new_location_from_old_location_steps','newlocation_cattle_guards','newlocation_power_line','newlocation_other','newlocation_feet','new_location','pdf_path'];

    public function customFields()
    {
        return $this->hasMany(CustomField::class, 'direction_id', 'id');
    }

}
