<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routedirection extends Model
{
    protected $table = 'route_directions';

    protected $fillable = ['record_type_id','direction_form_id','route_assessment_form_id','new_location','labelName', 'cattle_guards', 'power_line', 'other', 'feet','inches','distance','hazard_id','instruction','note','measurement_id'];  


    public function getHazardBasedOnRecords()
    {
        return $this->belongsTo(Hazard::class, 'hazard_id', 'id');
    }
    public function getMeasurementBasedOnRecords()
    {
        return $this->belongsTo(Measurement::class, 'measurement_id', 'id');
    }
}
