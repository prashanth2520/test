<?php 
namespace App\Repositories;
use App\Models\Record;
use App\Models\CustomField;
use App\Models\DirectionForm;
use App\Models\RouteAssessmentForm;
use App\Models\GroupMember;
use App\Repositories\Interfaces\RecordsRepositoryInterface;
use App\Http\Controllers\Traits\CreateTrait;
use App\Models\TemperatureOption;
use App\Models\Hazard;
use App\Models\Measurement;

class RecordsRepository implements RecordsRepositoryInterface
{

    use CreateTrait;

    public function hasRecord($rec_id)
    {
        return Record::where('id', $rec_id)->count();
    }

    public function hasDirectionByRecId($rec_id)
    {
        return DirectionForm::where('record_id', $rec_id)->count();
    }
    
    public function hasRouteAssessmentByRecId($rec_id)
    {
        return RouteAssessmentForm::where('record_id', $rec_id)->count();
    }
  
    public function getRouteAssessmentIDByRecId($rec_id)
    {
        return RouteAssessmentForm::where('record_id', $rec_id)->pluck('id');
    }
    public function getAllRecords()
    {
        return Record::with(['userDetails', 'directionForm', 'routeAssessmentForm'])->orderBy('created_at', 'desc')->get();
    }
    
    public function getRecords(int $rec_id)
    {
        return Record::where('id', $rec_id)->first();
    }

    public function getRecordsWithUser(int $rec_id)
    {
        return Record::with('userDetails')->where('id', $rec_id)->first();
    }

    public function getDirection(int $rec_id)
    {
        return DirectionForm::with('customFields')->where('record_id', $rec_id)->first();
    }

    public function getRouteAssessment(int $rec_id)
    {
        return RouteAssessmentForm::with(['customFields','temperatureOption','temperatureOption.temperature'])->where('record_id', $rec_id)->first();
    }

    public function getAllRecordsByUser($user_id)
    {
        return Record::with(['userDetails', 'directionForm', 'routeAssessmentForm'])->where('created_by', $user_id)->orderBy('created_at', 'desc')->get();
    }
    
    public function getCustomFields(int $rec_id)
    {
        return Record::with('customFields')->where('id', $rec_id)->get();
    }
    
    public function updateRecord($rec_id, $request)
    {
        return Record::where('id', $rec_id)->update($request);
    }

    public function updateDirectionForms($rec_id, $request)
    {
        return DirectionForm::where('record_id', $rec_id)->update($request);
    }

    public function updateRouteAssessmentForms($rec_id, $request)
    {
        return RouteAssessmentForm::where('record_id', $rec_id)->update($request);
    }

    public function updateCustomFields($custom_fields)
    {
        return CustomField::where('id', $custom_fields['id'])->update(['value'=>$custom_fields['value']]);
    }

    public function getIndividualsByGroup($group_ids)
    {
        return GroupMember::whereIn('group_id', $group_ids)->pluck('individual_id')->toArray();
    }

    public function temperatureOptionRemove($assessmentId){
        return TemperatureOption::whereIn('route_assessment_forms_id',$assessmentId)->delete();
    }

    public function hasTemperatureOptionByAssessmentId($assessmentId)
    {
        return TemperatureOption::whereIn('route_assessment_forms_id', $assessmentId)->count();
    }

    public function getHazardMenuList()
    {
        return Hazard::all();
    }

    public function getMeasurementMenuList()
    {
        return Measurement::all();
    }


    
}



?>