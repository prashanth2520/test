<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureOption extends Model
{
    use HasFactory;
    protected $table = 'temperature_option';
    protected $fillable = ['route_assessment_forms_id','temperature_id'];

    public function temperature()
    {
        return $this->belongsTo(Temperature::class, 'temperature_id', 'id');
    }
}
