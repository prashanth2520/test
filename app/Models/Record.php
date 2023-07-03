<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'records';
    protected $fillable = ['created_by','record_by','form_name','rig_name','rig_no','job_no'];

    public function userDetails()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function directionForm()
    {
        return $this->hasOne(DirectionForm::class, 'record_id', 'id');
    }

    public function routeAssessmentForm()
    {
        return $this->hasOne(RouteAssessmentForm::class, 'record_id', 'id');
    }

    public function customFields()
    {
        return $this->hasMany(CustomField::class, 'record_id', 'id');
    }

    public function recordType()
    {
        return $this->belongsTo(RecordType::class, 'record_type', 'id');
    }

    public function getDirectionFormPdf(){

        return $this->hasOne(DirectionForm::class, 'record_id', 'id')->select('id','record_id','pdf_path','created_at');
    }

    public function getRouteAssessmentFormPdf(){

        return $this->hasOne(RouteAssessmentForm::class, 'record_id', 'id')->select('id','record_id','pdf_path','created_at');
    }

}

