<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use App\Services\Interfaces\RecordsServiceInterface;
use App\Http\Controllers\Traits\CreateTrait;
use App\Repositories\RecordsRepository;
use App\Services\PDFService;
use App\Jobs\ShareRecordsJob;

use App\Models\Record;
use App\Models\Individual;
use App\Models\RouteAssessmentForm;
use App\Models\DirectionForm;
use App\Models\Routedirection;
use App\Models\RigType;
use App\Models\MoveType;
use App\Models\RigStatus;
use App\Models\Temperature;
use App\Models\TemperatureOption;


class RecordsService implements RecordsServiceInterface
{
    use CreateTrait;

    protected $record_array, $pdf;

    public function __construct(RecordsRepository $record_array, PDFService $pdf)
    {
        $this->record = $record_array;
        $this->pdf = $pdf;
    }

    public function getAllRecords()
    {
        $result = array();
        $record = array();
        $user = Auth::user();
        
        try {
            if ($user['user_role'] == 2) {
                $record = $this->record->getAllRecordsByUser($user['id']);
               
            } else {
                $record = $this->record->getAllRecords();
            }

            if (sizeOf($record) > 0) {
                foreach ($record as $data) {
                   
                    $user_id = ($user['user_role'] == 2) ? $user['id'] : $data['created_by'];

                    if (($data['record_type'] == 1 || $data['record_type'] == 3) && (isset($data['directionForm']) && !empty($data['directionForm']))) {
                       
                        $pdf_name = 'storage/form_pdf/' . $user_id . '/' . $data['id'] . '/direction/';
        
                        $data['pdf_name_direction'] = str_replace($pdf_name, '', $data['directionForm']['pdf_path']);

                    } else {
                        $data['pdf_name_direction'] = '';
                    }
                
                    if (($data['record_type'] == 2 || $data['record_type'] == 3) && (isset($data['routeAssessmentForm']) && !empty($data['routeAssessmentForm']))) {
                        $pdf_name = 'storage/form_pdf/' . $user_id . '/' . $data['id'] . '/route_assessment/';
                        $data['pdf_name_route'] = str_replace($pdf_name, '', $data['routeAssessmentForm']['pdf_path']);
                    } else {
                        $data['pdf_name_route'] = '';
                    }
                }

                $result = $record;
            }

            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function getRecords(int $rec_id)
    {
        $result = array();
        try {
            $result = $this->record->getRecords($rec_id);
            //dd(count($result['customFields']));
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function getDirection(int $rec_id)
    {
        $result = array();
        try {
            $result = $this->record->getDirection($rec_id);
            //dd(count($result['customFields']));
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function getRouteAssessment(int $rec_id)
    {
        $result = array();
        try {
            $result = $this->record->getRouteAssessment($rec_id);
         
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function saveRecord(array $request)
    {

        $result = 0;
        $record_array = array();
        $rec_id = 0;
        try {
            $form_name = $this->checkFormName($request['record_name']);
            $record_array['record_type'] = $request['record_type'];
            $record_array['form_name'] =  $form_name;
            $record_array['rig_name'] =  $request['rig_name'];
            $record_array['rig_no'] =  $request['rig_no'];
            $record_array['job_no'] =  $request['job_no'];
            $save = self::createRecord($record_array);
            $result = isset($save->id) ? $save->id : 0;
            //dd($result);
            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function saveFormRecords(array $request)
    {
           
        $result = 0;
        $save_record = $save_direction =  $save_route_assessment = $saveTemperatureOption =  0;
        try {

            $save_record = $this->recordSave($request);

            $save_direction = $this->directionSave($request);
           
            $save_route_assessment = $this->routeAssessSave($request);
            if($request['rec_type']!==2){
                if(isset($request['temperature'])){
                    $routeAssessmentId = $this->record->getRouteAssessmentIDByRecId($request['rec_id']);
                    $saveTemperatureOption= $this->record->temperatureOptionRemove($routeAssessmentId);
                    $saveTemperatureOption=$this->temperatureOptionSave($request);
                }else{
                    $routeAssessmentId = $this->record->getRouteAssessmentIDByRecId($request['rec_id']);
                    $temperatureOptionCount=$this->record->hasTemperatureOptionByAssessmentId($routeAssessmentId);
                   if($temperatureOptionCount>0){
                       $saveTemperatureOption= $this->record->temperatureOptionRemove($routeAssessmentId);
                   }else{
                    $saveTemperatureOption=1;
                   }
                }
            }
          
            if (isset($request['customField']) && !empty($request['customField'])) {
                $add_custom_fields = $this->addCustomFields($request['rec_id'],  $request['customField']);
            }
            if (isset($request['customFieldEdit']) && !empty($request['customFieldEdit'])) {
                $edit_custom_fields = $this->editCustomFields($request['customFieldEdit']);
            }

            if($request['rec_type']!==2){
                $result = $save_direction > 0 && $save_route_assessment > 0  && $save_record > 0 && $saveTemperatureOption> 0 ? 1 : 0;
            }   
            $result = $save_direction > 0 && $save_route_assessment > 0  && $save_record > 0 ? 1 : 0;

            if ($result > 0) {
                $this->pdf->generatePDF($request['rec_id']);
            }
            // print_r($result);die;
            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function addCustomFields(int $rec_id, array $custom_fields_array)
    {
        $result = '';
        $dc_array = array();
        $rac_array = array();
        try {
            if (isset($custom_fields_array['direction']) && !empty($custom_fields_array['direction'])) {
                $dc_array = array_values($custom_fields_array['direction']);
            }

            if (isset($custom_fields_array['route']) && !empty($custom_fields_array['route'])) {
                $rac_array = array_values($custom_fields_array['route']);
            }

            if (!empty($dc_array)) {
                $has_direction = $this->record->hasDirectionByRecId($rec_id);
                if ($has_direction > 0) {
                    $get_direction = $this->record->getDirection($rec_id);
                    foreach ($dc_array as $dca) {
                        if ($dca['value'] != '') {
                            $create_custom = self::createCustomFields($get_direction['id'], NULL, $dca);
                        }
                    }
                }
            }

            if (!empty($rac_array)) {
                $has_route_assessment = $this->record->hasRouteAssessmentByRecId($rec_id);
                if ($has_route_assessment > 0) {
                    $get_route_assessment = $this->record->getRouteAssessment($rec_id);
                    foreach ($rac_array as $rac) {
                        if ($rac['value'] != '') {
                            $create_custom = self::createCustomFields(NULL, $get_route_assessment['id'], $rac);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function editCustomFields(array $custom_field_edit_array)
    {
        try {
            if (!empty($custom_field_edit_array)) {
                foreach ($custom_field_edit_array as $cfa) {
                    $update_cf = $this->record->updateCustomFields($cfa);
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function recordArray(array $request)
    {
        $record_array = array();
        $record_array['record_type'] = isset($request['rec_type']) && $request['rec_type'] != '' ? $request['rec_type'] : NULL;
        $record_array['rig_name'] = isset($request['rigName']) && $request['rigName'] != '' ? $request['rigName'] : NULL;
        $record_array['rig_no'] = isset($request['rigNo']) && $request['rigNo'] != '' ? $request['rigNo'] : NULL;
        $record_array['job_no'] = isset($request['jobNo']) && $request['jobNo'] != '' ? $request['jobNo'] : NULL;
        return $record_array;
    }

    public function routeAssessmentArray(array $request)
    {

        $route_assessment_array = array();
        $route_assessment_array['record_id'] = isset($request['rec_id']) && $request['rec_id'] != '' ? $request['rec_id'] : NULL;
        $route_assessment_array['date_time'] = isset($request['dateTime']) && $request['dateTime'] != '' ? date("Y-m-d H:i:s", strtotime($request['dateTime'])) : NULL;
        //$route_assessment_array['job_no'] = isset($request['jobNo']) && $request['jobNo'] != '' ? $request['jobNo'] : NULL; 
        // $route_assessment_array['temperature'] = isset($request['temperature']) && $request['temperature'] != '' ? $request['temperature'] : NULL;
        $route_assessment_array['route_assessment'] = isset($request['routeAssessment']) && $request['routeAssessment'] != '' ? $request['routeAssessment'] : NULL;
        //$route_assessment_array['rig_name'] = isset($request['rigName']) && $request['rigName'] != '' ? $request['rigName'] : NULL; 
        //$route_assessment_array['rig_no'] = isset($request['rigNo']) && $request['rigNo'] != '' ? $request['rigNo'] : NULL; 
        $route_assessment_array['rig_type_id'] = isset($request['rigType']) && $request['rigType'] != '' ? $request['rigType'] : NULL;
        $route_assessment_array['rig_manager'] = isset($request['rigManager']) && $request['rigManager'] != '' ? $request['rigManager'] : NULL;
        $route_assessment_array['rig_phone'] = isset($request['rigPhone']) && $request['rigPhone'] != '' ? $request['rigPhone'] : NULL;
        $route_assessment_array['rig_email'] = isset($request['rigEmail']) && $request['rigEmail'] != '' ? $request['rigEmail'] : NULL;
        $route_assessment_array['afe_no'] = isset($request['aef']) && $request['aef'] != '' ? $request['aef'] : NULL;
        $route_assessment_array['move_type_id'] = isset($request['moveType']) && $request['moveType'] != '' ? $request['moveType'] : NULL;
        $route_assessment_array['est_miles'] = isset($request['estMiles']) && $request['estMiles'] != '' ? $request['estMiles'] : NULL;
        $route_assessment_array['operator'] = isset($request['operator']) && $request['operator'] != '' ? $request['operator'] : NULL;
        $route_assessment_array['operator_email'] = isset($request['operatorEmail']) && $request['operatorEmail'] != '' ? $request['operatorEmail'] : NULL;
        // $route_assessment_array['operator_dms'] = isset($request['operatorDsm']) && $request['operatorDsm'] != '' ? $request['operatorDsm'] : NULL;
        $route_assessment_array['old_location'] = isset($request['oldLoc']) && $request['oldLoc'] != '' ? $request['oldLoc'] : '';
        $route_assessment_array['old_gps_coordinates'] = isset($request['oldLocgps']) && $request['oldLocgps'] != '' ? $request['oldLocgps'] : '';
        $route_assessment_array['old_location_latitude'] = isset($request['olLatitude']) && $request['olLatitude'] != '' ? $request['olLatitude'] : NULL;
        $route_assessment_array['old_location_longitude'] = isset($request['olLongitude']) && $request['olLongitude'] != '' ? $request['olLongitude'] : NULL;
        $route_assessment_array['old_emergency'] = isset($request['oldLocEc']) && $request['oldLocEc'] != '' ? $request['oldLocEc'] : NULL;
        $route_assessment_array['old_closest_emergency_room'] = isset($request['oldLoccer']) && $request['oldLoccer'] != '' ? $request['oldLoccer'] : NULL;
        $route_assessment_array['new_location'] = isset($request['newLoc']) && $request['newLoc'] != '' ? $request['newLoc'] : '';
        $route_assessment_array['new_gps_coordinates'] = isset($request['newLocgps']) && $request['newLocgps'] != '' ? $request['newLocgps'] : '';
        $route_assessment_array['new_location_latitude'] = isset($request['newLatitude']) && $request['newLatitude'] != '' ? $request['newLatitude'] : NULL;
        $route_assessment_array['new_location_longitude'] = isset($request['newLongitude']) && $request['newLongitude'] != '' ? $request['newLongitude'] : NULL;
        $route_assessment_array['new_emergency'] = isset($request['newLocEc']) && $request['newLocEc'] != '' ? $request['newLocEc'] : NULL;
        $route_assessment_array['new_closest_emergency_room'] = isset($request['newLoccer']) && $request['newLoccer'] != '' ? $request['newLoccer'] : NULL;

        $route_assessment_array['total_miles'] = isset($request['totalMiles']) && $request['totalMiles'] != '' ? $request['totalMiles'] : NULL;
        $route_assessment_array['total_cattle_gaurds'] = isset($request['totalCattGuard']) && $request['totalCattGuard'] != '' ? $request['totalCattGuard'] : NULL;
        $route_assessment_array['total_overhead_harzards'] = isset($request['totalOverHazard']) && $request['totalOverHazard'] != '' ? $request['totalOverHazard'] : NULL;
        $route_assessment_array['total_guide_wire'] = isset($request['totalGuideWire']) && $request['totalGuideWire'] != '' ? $request['totalGuideWire'] : NULL;
        $route_assessment_array['lowest_overhead_harzards'] = isset($request['lowestOverHazard']) && $request['lowestOverHazard'] != '' ? $request['lowestOverHazard'] : NULL;
        $route_assessment_array['lowest_overhead_harzards_feet'] = isset($request['lowestOverHazardFeet']) && $request['lowestOverHazardFeet'] != '' ? $request['lowestOverHazardFeet'] : NULL;
        $route_assessment_array['lowest_overhead_harzards_inches'] = isset($request['lowestOverHazardInches']) && $request['lowestOverHazardInches'] != '' ? $request['lowestOverHazardInches'] : NULL;
        $route_assessment_array['lowest_power_line'] = isset($request['lowestPowerLine']) && $request['lowestPowerLine'] != '' ? $request['lowestPowerLine'] : NULL;
        $route_assessment_array['lowest_power_line_feet'] = isset($request['lowestPowerLineFeet']) && $request['lowestPowerLineFeet'] != '' ? $request['lowestPowerLineFeet'] : NULL;
        $route_assessment_array['lowest_power_line_inches'] = isset($request['lowestPowerLineInches']) && $request['lowestPowerLineInches'] != '' ? $request['lowestPowerLineInches'] : NULL;
        $route_assessment_array['route_assessor_name'] = isset($request['routeAssessorsName']) && $request['routeAssessorsName'] != '' ? $request['routeAssessorsName'] : NULL;
        $route_assessment_array['route_assessor_email'] = isset($request['routeAssessorsEmail']) && $request['routeAssessorsEmail'] != '' ? $request['routeAssessorsEmail'] : NULL;
        $route_assessment_array['route_assessor_phone'] = isset($request['routeAssessorPhone']) && $request['routeAssessorPhone'] != '' ? $request['routeAssessorPhone'] : NULL;
        $route_assessment_array['rig_status_id'] = isset($request['rigStatus']) && $request['rigStatus'] != '' ? $request['rigStatus'] : NULL;
        $route_assessment_array['goal_post_feet'] = isset($request['goalPostFeet']) && $request['goalPostFeet'] != '' ? $request['goalPostFeet'] : NULL;
        $route_assessment_array['goal_post_inches'] = isset($request['goalPostInches']) && $request['goalPostInches'] != '' ? $request['goalPostInches'] : NULL;

        
        

        return $route_assessment_array;
    }

    public function routeDirectionArray(array $request)
    {
        $direction_array = array();
        $direction_array['record_id'] = isset($request['rec_id']) && $request['rec_id'] != '' ? $request['rec_id'] : NULL;
        $direction_array['from_location'] = isset($request['olFrom']) && $request['olFrom'] != '' ? $request['olFrom'] : NULL;
        $direction_array['old_location'] = isset($request['olName']) && $request['olName'] != '' ? $request['olName'] : '';
        $direction_array['add_new_location'] = isset($request['addNewLocation']) && $request['addNewLocation'] != '' ? $request['addNewLocation'] : '';
        $direction_array['latitude'] = isset($request['latitude']) && $request['latitude'] != '' ? $request['latitude'] : NULL;
        $direction_array['langitude'] = isset($request['olLangitude']) && $request['olLangitude'] != '' ? $request['olLangitude'] : NULL;
        $direction_array['drilling_rig_name'] = isset($request['olRigName']) && $request['olRigName'] != '' ? $request['olRigName'] : NULL;
        $direction_array['drilling_rig_no'] = isset($request['olRigNo']) && $request['olRigNo'] != '' ? $request['olRigNo'] : NULL;
        // $direction_array['old_location_steps'] = isset($request['olSteps']) && $request['olSteps'] != '' ? $request['olSteps'] : NULL;
        // $direction_array['oldlocation_cattle_guards'] = isset($request['oldLoc_CattGuard']) && $request['oldLoc_CattGuard'] != '' ? $request['oldLoc_CattGuard'] : NULL;
        // $direction_array['oldlocation_power_line'] = isset($request['oldLoc_Powerline']) && $request['oldLoc_Powerline'] != '' ? $request['oldLoc_Powerline'] : NULL;
        // $direction_array['oldlocation_other'] = isset($request['oldLoc_Other']) && $request['oldLoc_Other'] != '' ? $request['oldLoc_Other'] : NULL;
        // $direction_array['oldlocation_feet'] = isset($request['oldLoc_Feet']) && $request['oldLoc_Feet'] != '' ? $request['oldLoc_Feet'] : NULL;
        //  $direction_array['new_location_from_old_location'] = isset($request['nlFromolName']) && $request['nlFromolName'] != '' ? $request['nlFromolName'] : NULL;
        // $direction_array['new_location_from_old_location_steps'] = isset($request['nlFromolSteps']) && $request['nlFromolSteps'] != '' ? $request['nlFromolSteps'] : NULL;
        // $direction_array['newlocation_cattle_guards'] = isset($request['newLoc_CattGuard']) && $request['newLoc_CattGuard'] != '' ? $request['newLoc_CattGuard'] : NULL;
        // $direction_array['newlocation_power_line'] = isset($request['newLoc_Powerline']) && $request['newLoc_Powerline'] != '' ? $request['newLoc_Powerline'] : NULL;
        // $direction_array['newlocation_other'] = isset($request['newLoc_Other']) && $request['newLoc_Other'] != '' ? $request['newLoc_Other'] : NULL;
        // $direction_array['newlocation_feet'] = isset($request['newLoc_Feet']) && $request['newLoc_Feet'] != '' ? $request['newLoc_Feet'] : NULL;
        // $direction_array['new_location'] = isset($request['nlName']) && $request['nlName'] != '' ? $request['nlName'] : NULL;

        return $direction_array;
    }

    public function travelDirectionArray($request)
    {
        $travel_direction_array['direction_steps'] = isset($request['nlSteps']) && $request['nlSteps'] != '' ? $request['nlSteps'] : NULL;
        $travel_direction_array['direction_cattle_guards'] = isset($request['dnewLoc_CattGuard']) && $request['dnewLoc_CattGuard'] != '' ? $request['dnewLoc_CattGuard'] : NULL;
        $travel_direction_array['direction_power_line'] = isset($request['dnewLoc_Powerline']) && $request['dnewLoc_Powerline'] != '' ? $request['dnewLoc_Powerline'] : NULL;
        $travel_direction_array['direction_other'] = isset($request['dnewLoc_Other']) && $request['dnewLoc_Other'] != '' ? $request['dnewLoc_Other'] : NULL;
        // $travel_direction_array['direction_feet'] = isset($request['dnewLoc_Feet']) && $request['dnewLoc_Feet'] != '' ? $request['dnewLoc_Feet'] : NULL;

        return $travel_direction_array;
    }

    public function travelRouteArray($request)
    {
        
        $travel_route_array['route_steps'] = isset($request['directnewLoc']) && $request['directnewLoc'] != '' ? $request['directnewLoc'] : NULL;
        $travel_route_array['route_cattle_guards'] = isset($request['beginCattGuard']) && $request['beginCattGuard'] != '' ? $request['beginCattGuard'] : NULL;
        $travel_route_array['route_power_line'] = isset($request['beginPowerline']) && $request['beginPowerline'] != '' ? $request['beginPowerline'] : NULL;
        $travel_route_array['route_other'] = isset($request['beginOther']) && $request['beginOther'] != '' ? $request['beginOther'] : NULL;
        $travel_route_array['route_feet'] = isset($request['beginFeet']) && $request['beginFeet'] != '' ? $request['beginFeet'] : NULL;

        return $travel_route_array;
    }

    public function checkFormName($form_name)
    {
        $user = Auth::user();
        $check_name = Record::where('created_by', $user['id'])->where('form_name', $form_name)->count();
        if ($check_name > 0) {
            $count = $check_name + 1;
            $form_name = $form_name . '(' . $count . ')';
        } else {
            $form_name = $form_name;
        }

        return $form_name;
    }

    public function recordSave(array $request)
    {
        $result = 0;
        $record_array = array();
        $save_record = 0;
        try {
            $record_array = $this->recordArray($request);
            $has_record = $this->record->hasRecord($request['rec_id']);
            if ($has_record > 0 && !empty($record_array)) {
                $save_record = $this->record->updateRecord($request['rec_id'], $record_array);
            }
            $result = $save_record;
            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function directionSave(array $request)
    {
        $result = 0;
        $direction_array = array();
        $save_direction = 0;
        try {
            $direction_array = $this->routeDirectionArray($request);
            $has_direction = $this->record->hasDirectionByRecId($request['rec_id']);
            if (!empty($direction_array) && ($request['rec_type'] == 1 || $request['rec_type'] == 3)) {
                if ($has_direction > 0) {
                    $save_direction = $this->record->updateDirectionForms($request['rec_id'], $direction_array);
                    $direction_id = DirectionForm::where('record_id',$request['rec_id'])->first();
                    Routedirection::where('direction_form_id',$direction_id->id)->delete();
                    if(isset($request['direction_new_location']) && $request['direction_new_location']){
                        $this->saveDirection($request,$direction_id->id);
                    }
                } else {
                    $save_d = self::createDirectionForms($direction_array);
                    $save_direction = isset($save_d->id) ? 1 : 0;
                    if(isset($request['direction_new_location']) && $request['direction_new_location']){
                        $this->saveDirection($request, $save_d->id);
                    }
                }
            } else {
                $save_direction = 1;
            }
            $result = $save_direction;
            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function saveDirection($request_info, $direction_id, $direction=true){

        for($i=0;$i<count($request_info['direction_new_location']);$i++){
            $route = new Routedirection();
            $route->record_type_id = $request_info['rec_type'];
            if($direction){
                $route->direction_form_id = $direction_id;
            } else {
                $route->route_assessment_form_id = $direction_id;
            }
            $route->new_location = $request_info['direction_new_location'][$i];
            $route->label = $request_info['dynamicLabel'][$i];
            $route->labelName = $request_info['labelName'][$i];
            // $route->cattle_guards = $request_info['direction_cattle_guard'][$i];
            // $route->power_line = $request_info['direction_powerline'][$i];
            // $route->other = $request_info['direction_other'][$i];
            // $route->feet = $request_info['direction_feet'][$i];
            $route->save();
        }
        
    }

    public function saveAssessment($request_info, $assessment_id){

        for($i=0;$i<count($request_info['hazardMenu']);$i++){
            $route = new Routedirection();
            $route->record_type_id = $request_info['rec_type'];
            $route->route_assessment_form_id = $assessment_id;
            $route->labelName = $request_info['hazardHeader'][$i];
            $route->distance = $request_info['hazardDistance'][$i];
            $route->hazard_id = $request_info['hazardMenu'][$i];
            $route->feet = ($request_info['hazardFeet'][$i])?str_replace("'", "", $request_info['hazardFeet'][$i]):null;
            $route->inches = ($request_info['hazardInches'][$i])?str_replace('"', "", $request_info['hazardInches'][$i]):null;
            $route->instruction = $request_info['hazardInstruction'][$i];
            $route->note = $request_info['hazardNote'][$i];
            $route->measurement_id = $request_info['hazardMeasurement'][$i];
            $route->save();
        }
        
    }


    public function routeAssessSave(array $request)
    {
        $result = 0;
        $route_assessment_array = array();
        $save_route_assessment = 0;
        try {
            $route_assessment_array = $this->routeAssessmentArray($request);

         
            $has_route_assessment = $this->record->hasRouteAssessmentByRecId($request['rec_id']);
            if (!empty($route_assessment_array) && ($request['rec_type'] == 2 || $request['rec_type'] == 3)) {
             
                if ($has_route_assessment > 0) {
                    $save_route_assessment = $this->record->updateRouteAssessmentForms($request['rec_id'], $route_assessment_array);

                    $assessment_id = RouteAssessmentForm::where('record_id',$request['rec_id'])->first();
                    Routedirection::where('route_assessment_form_id',$assessment_id->id)->delete();
                    if(isset($request['hazardMenu'])){
                        $this->saveAssessment($request, $assessment_id->id);
                    }
                    if(isset($request['direction_route_new_location']) && $request['direction_route_new_location']){
                        $request['direction_new_location']=$request['direction_route_new_location'];
                        $request['dynamicLabel']=$request['routeDynamicLabel'];
                        $request['labelName']=$request['routeLabelName'];
                        $this->saveDirection($request, $assessment_id->id, false);
                    }

                } else {
                   
                    $save_r = self::createRouteAssessmentForms($route_assessment_array);
                    $save_route_assessment = isset($save_r->id) ? 1 : 0;
                    if (isset($request['hazardMenu'])) {
                        $this->saveAssessment($request, $save_r->id);
                    }
                    if(isset($request['direction_route_new_location']) && $request['direction_route_new_location']){
                        $request['direction_new_location']=$request['direction_route_new_location'];
                        $request['dynamicLabel']=$request['routeDynamicLabel'];
                        $request['labelName']=$request['routeLabelName'];
                        $this->saveDirection($request, $save_r->id, false);
                    }
                }
            } else {
                $save_route_assessment = 1;
            }
            $result = $save_route_assessment;
            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }


    public function temperatureOptionSave(array $request)
    {       
        $saveTemperatureOption=0;
        try {
                $routeAssessmentId = $this->record->getRouteAssessmentIDByRecId($request['rec_id']);
                foreach($routeAssessmentId as $routeAssessmentIdValue ){
                    foreach($request['temperature'] as $temperatureId){
                        $temperatureOption = new TemperatureOption();
                        $temperatureOption->route_assessment_forms_id = $routeAssessmentIdValue;
                        $temperatureOption->temperature_id = $temperatureId;
                        $temperatureOption->save();
                    }
                } 
                
                return  $saveTemperatureOption=1;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return $saveTemperatureOption;
            }
            
        }

    public function sharePDF(array $request)
    {

        $result = 0;
        $individuals = [];
        $currentURL = URL::current();
        $pieces = explode("/", $currentURL);

        try {
            if ($request['share-option'] == 'individuals') {
                $individuals = $request['ids'];
            } else {
                $group_ids = $request['ids'];
                $individuals = $this->record->getIndividualsByGroup($group_ids);
            }
            $route_url = RouteAssessmentForm::where('record_id', $request['shareid'])->pluck('pdf_path')->first();
            $direction_url = DirectionForm::where('record_id', $request['shareid'])->pluck('pdf_path')->first();

            $route_url = ($route_url != Null) ? $pieces[0] . "//" . $pieces[2] . "/" . $route_url : Null;
            $direction_url = ($direction_url != Null) ? $pieces[0] . "//" . $pieces[2] . "/" .  $direction_url : Null;

            $url =   ($route_url != Null) ? Str::replace(" ", "%20", $route_url) : Null;
            $drl =   ($direction_url != Null) ? Str::replace(" ", "%20", $direction_url) : Null;

            if (!empty($individuals) && ($url != Null ||  $drl != Null)) {
                foreach ($individuals as $individual) {
                    $individualsRecord = Individual::select('email')->where('id', $individual)->first();
                    if ($individualsRecord) {
                        $details['email'] = $individualsRecord->email;
                        if ($url != Null) {
                            $details['filename'][] = $url;
                        }
                        if ($drl != Null) {
                            $details['filename'][] = $drl;
                        }
                        // $string = 'Laravel 8.x';
                        // $replaced = Str::replace('8.x', '9.x', $string);
                        // dd($replaced);die;                          
                        // dd($details);
                        dispatch(new ShareRecordsJob($details));
                    }
                }
                $result = 1;
            }

            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }


    public function getRidType()
    {
        $ridType=[];
        
        try {
              return  RigType::all();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $ridType;
        }
    }

    public function getMoveType()
    {
        $moveType=[];
        try {
              return  MoveType::all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $moveType;
        }
    }

    
    public function getRigStatus()
    {
        $rigStatus=[];
        try {
              return  RigStatus::all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $rigStatus;
        }
    }

    public function getTemperature(){
        $temperature=[];
        try {
            return  Temperature::all();
      } catch (\Exception $e) {
          Log::error($e->getMessage());
          return $temperature;
      }

    }

    public function getRecordsWithUser(int $rec_id)
    {
        $result = array();
        try {
            $result = $this->record->getRecordsWithUser($rec_id);
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function getHazardList()
    {
        $result = array();
        try {
            $result = $this->record->getHazardMenuList();
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }

    }

    public function getMeasurementList()
    {
        $result = array();
        try {
            $result = $this->record->getMeasurementMenuList();
            return  $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }

    }

    






    
}
