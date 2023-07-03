<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    use HasFactory;

    protected $table = 'employee_details';
    protected $fillable = ['user_id','emp_id','jobgroup_id','titleposition_id','region_id','phone','location_id','group_id'];

}
