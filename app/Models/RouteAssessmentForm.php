<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteAssessmentForm extends Model
{
    use HasFactory;

    protected $table = 'route_assessment_forms';
    protected $fillable = ['record_id','date_time','temperature','route_assessment','rig_manager','rig_phone','rig_email','rig_status_id','rig_type_id','afe_no','move_type_id','est_miles','operator','operator_email','operator_dms','old_location','old_gps_coordinates','old_emergency','old_closest_emergency_room','new_location','new_gps_coordinates','new_location_latitude','new_location_longitude','new_emergency','new_closest_emergency_room','goal_post_feet','goal_post_inches','total_miles','total_cattle_gaurds','total_overhead_harzards','total_guide_wire','lowest_overhead_harzards','lowest_overhead_harzards_feet','lowest_overhead_harzards_inches','lowest_power_line','lowest_power_line_feet','lowest_power_line_inches','route_assessor_name','route_assessor_email','route_assessor_phone','pdf_path'

    ];

    public function customFields()
    {
        return $this->hasMany(CustomField::class, 'route_assessment_id', 'id');
    }
    public function temperatureOption()
    {
        return $this->hasMany(TemperatureOption::class, 'route_assessment_forms_id', 'id');
    }
   
}
