<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory;
    protected $table = 'custom_fields';
    protected $fillable = ['direction_id','route_assessment_id','input_type','label','value','sortorder'];

}
