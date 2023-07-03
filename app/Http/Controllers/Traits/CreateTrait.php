<?php 
namespace App\Http\Controllers\Traits;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\EmployeeDetails;
use App\Models\Record;
use App\Models\CustomField;
use App\Models\DirectionForm;
use App\Models\RouteAssessmentForm;
use App\Models\Individual;
use App\Models\Group;
use App\Models\Location;
use App\Models\UserLocationDetails;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


trait CreateTrait
{
    //users
    public function createUsers($user_array){
        try{
            $user = User::create([
                'name' => $user_array['name'],
                'email' =>  strtolower($user_array['email']),
                'password' => Hash::make($user_array['password']),
                'user_role' => intval($user_array['user_role']),
                'pro_pic' => isset($user_array['pro_pic']) && $user_array['pro_pic'] != '' ?  $user_array['pro_pic'] : NULL
            ]);

            if($user->id > 0){
                return $user;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    //employee_details
    public function createEmployeeDetails($employee_details_array){
        try{
            $employee_details = new EmployeeDetails;
            $employee_details->user_id = $employee_details_array['user_id'];
            $employee_details->emp_id = $employee_details_array['emp_id'];
            $employee_details->jobgroup_id = $employee_details_array['jobgroup_id'];
            $employee_details->titleposition_id = $employee_details_array['titleposition_id'];
            $employee_details->region_id = $employee_details_array['region_id'];
            $employee_details->phone = isset($employee_details_array['phone']) && $employee_details_array['phone'] != '' ?  $employee_details_array['phone'] : NULL;
            $employee_details->save();
            if($employee_details->id > 0){
                return $employee_details;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    //records
    public function createRecord($record_array){
        try{
            $user = Auth::user();
            
            $record = new Record;
            $record->created_by = $user['id']; 
            $record->record_type = $record_array['record_type']; 
            $record->form_name = $record_array['form_name']; 
            $record->rig_name = $record_array['rig_name']; 
            $record->rig_no = $record_array['rig_no']; 
            $record->job_no = $record_array['job_no']; 
            $record->save();

            if($record->id > 0){
                return $record;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    //direction_forms
    public function createDirectionForms($direction_array){
        try{
            $user = Auth::user();
            $direction_form = new DirectionForm;
            $direction_form['record_id'] = $direction_array['record_id'];
            $direction_form['from_location'] = $direction_array['from_location'];
            $direction_form['old_location'] = $direction_array['old_location'];
            $direction_form['add_new_location'] = $direction_array['add_new_location'];
            $direction_form['latitude'] = $direction_array['latitude'];
            $direction_form['langitude'] = $direction_array['langitude'];
            $direction_form['drilling_rig_name'] = $direction_array['drilling_rig_name'];
            $direction_form['drilling_rig_no'] = $direction_array['drilling_rig_no'];
            // $direction_form['old_location_steps'] = $direction_array['old_location_steps'];
            // $direction_form['oldlocation_cattle_guards'] = $direction_array['oldlocation_cattle_guards'];
            // $direction_form['oldlocation_power_line'] = $direction_array['oldlocation_power_line'];
            // $direction_form['oldlocation_other'] = $direction_array['oldlocation_other'];
            // $direction_form['oldlocation_feet'] = $direction_array['oldlocation_feet'];
            // $direction_form['new_location_from_old_location'] = $direction_array['new_location_from_old_location'];
            // $direction_form['new_location_from_old_location_steps'] = $direction_array['new_location_from_old_location_steps'];
            // $direction_form['newlocation_cattle_guards'] = $direction_array['newlocation_cattle_guards'];
            // $direction_form['newlocation_power_line'] = $direction_array['newlocation_power_line'];
            // $direction_form['newlocation_other'] = $direction_array['newlocation_other'];
            // $direction_form['newlocation_feet'] = $direction_array['newlocation_feet'];
            // $direction_form['new_location'] = $direction_array['new_location'];

            $direction_form->save();

            if($direction_form->id > 0){
                return $direction_form;
            }else{
                return null;
            }
            
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    //route_assessment_forms
    public function createRouteAssessmentForms($route_assessment_array){

        try{
            $user = Auth::user();
            $route_assessment_form = new RouteAssessmentForm;
            $route_assessment_form->record_id = $route_assessment_array['record_id']; 
            $route_assessment_form->date_time = $route_assessment_array['date_time']; 
            // $route_assessment_form->job_no = $route_assessment_array['job_no']; 
            // $route_assessment_form->temperature = $route_assessment_array['temperature']; 
            $route_assessment_form->route_assessment = $route_assessment_array['route_assessment']; 
            // $route_assessment_form->rig_name = $route_assessment_array['rig_name']; 
            // $route_assessment_form->rig_no = $route_assessment_array['rig_no']; 
            $route_assessment_form->rig_type_id = $route_assessment_array['rig_type_id']; 
            $route_assessment_form->rig_manager = $route_assessment_array['rig_manager']; 
            $route_assessment_form->rig_phone = $route_assessment_array['rig_phone']; 
            $route_assessment_form->rig_email = $route_assessment_array['rig_email']; 
            $route_assessment_form->rig_status_id = $route_assessment_array['rig_status_id']; 
            $route_assessment_form->afe_no = $route_assessment_array['afe_no']; 
            $route_assessment_form->move_type_id = $route_assessment_array['move_type_id']; 
            $route_assessment_form->est_miles = $route_assessment_array['est_miles']; 
            $route_assessment_form->operator = $route_assessment_array['operator']; 
            $route_assessment_form->operator_email = $route_assessment_array['operator_email']; 
            // $route_assessment_form->operator_dms = $route_assessment_array['operator_dms']; 
            $route_assessment_form->old_location = $route_assessment_array['old_location']; 
            $route_assessment_form->old_gps_coordinates = $route_assessment_array['old_gps_coordinates']; 
            $route_assessment_form->old_location_latitude = $route_assessment_array['old_location_latitude']; 
            $route_assessment_form->old_location_longitude = $route_assessment_array['old_location_longitude']; 
            $route_assessment_form->old_emergency = $route_assessment_array['old_emergency']; 
            $route_assessment_form->old_closest_emergency_room = $route_assessment_array['old_closest_emergency_room']; 
            $route_assessment_form->new_location = $route_assessment_array['new_location']; 
            $route_assessment_form->new_gps_coordinates = $route_assessment_array['new_gps_coordinates']; 
            $route_assessment_form->new_location_latitude = $route_assessment_array['new_location_latitude']; 
            $route_assessment_form->new_location_longitude = $route_assessment_array['new_location_longitude'];
            $route_assessment_form->new_emergency = $route_assessment_array['new_emergency']; 
            $route_assessment_form->new_closest_emergency_room = $route_assessment_array['new_closest_emergency_room']; 
            
            $route_assessment_form->total_miles = $route_assessment_array['total_miles']; 
          
            $route_assessment_form->total_cattle_gaurds = $route_assessment_array['total_cattle_gaurds']; 
            $route_assessment_form->total_overhead_harzards = $route_assessment_array['total_overhead_harzards']; 
            $route_assessment_form->total_guide_wire = $route_assessment_array['total_guide_wire']; 
            $route_assessment_form->lowest_overhead_harzards = $route_assessment_array['lowest_overhead_harzards'];
            $route_assessment_form->lowest_overhead_harzards_feet = $route_assessment_array['lowest_overhead_harzards_feet'];
            $route_assessment_form->lowest_overhead_harzards_inches = $route_assessment_array['lowest_overhead_harzards_inches'];
            $route_assessment_form->lowest_power_line = $route_assessment_array['lowest_power_line'];
            $route_assessment_form->route_assessor_name = $route_assessment_array['route_assessor_name'];
            $route_assessment_form->route_assessor_email = $route_assessment_array['route_assessor_email'];
            $route_assessment_form->route_assessor_phone = $route_assessment_array['route_assessor_phone'];
            $route_assessment_form->goal_post_feet = $route_assessment_array['goal_post_feet'];
            $route_assessment_form->goal_post_inches=$route_assessment_array['goal_post_inches'];
            $route_assessment_form->save();
            if($route_assessment_form->id > 0){
                return $route_assessment_form;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }
    
    //custom_fields
    public function createCustomFields($direction_id, $route_assessment_id, $custom_field_array){
        try{
            $custom_field = new CustomField;
            $custom_field->direction_id = $direction_id;
            $custom_field->route_assessment_id = $route_assessment_id;
            $custom_field->input_type = $custom_field_array['type'];
            $custom_field->label = $custom_field_array['label'];
            $custom_field->value = $custom_field_array['value'];
            $custom_field->sortorder = isset($custom_field_array['sortorder']) && $custom_field_array['sortorder'] > 0 ?  $custom_field_array['sortorder'] : 0;
            $custom_field->save();
            if($custom_field->id > 0){
                return $custom_field;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    //individuals
    public function createIndividual($individual_array){
        try{        
            $user = Auth::user();

            $individual = Individual::create([
                    'name' => $individual_array['name'],
                    'email' => $individual_array['email'],
                    'belongs_to' =>  $user['id'],
                    'phone' => $individual_array['phone'],
                    'caption' => $individual_array['caption']
            ]);
      
            if(isset($individual_array['group']) && $individual_array['group']){
                $getpostion = Group::where('group_name',$individual_array['group'])->where('individual_user_id',$individual->id)->first();
                if(!$getpostion){
                    Group::create([
                        'created_by' => null,
                        'individual_user_id'=>$individual->id,
                        'group_name'=> $individual_array['group']
                    ]);
                }else{
                    Group::where('individual_user_id',$individual->id)->update([
                        'group_name' => $individual_array['group']
                    ]);
                } 
            }
            
            
            if(!empty($individual_array['location'])){
               
                foreach($individual_array['location'] as $location){
                    if(isset($location) && ($location != 'others')){
                        $getLocation = Location::where('location',$location)->first();
                        if(!$getLocation){
                            $new_location = Location::create([
                                'location' => $location,
                            ]);
                            UserLocationDetails::create([
                                'individual_user_id'=> $individual->id,
                                'location_id' =>  $new_location->id
                            ]);

                        }else{
                            $userlocation = UserLocationDetails::where('location_id',$getLocation->id)->where('individual_user_id', $individual->id)->first();
                            if(!$userlocation){
                                UserLocationDetails::create([
                                    'individual_user_id'=> $individual->id,
                                    'location_id' => $getLocation->id
                                ]);
                            }
                        }
                    }                    
                }
            }
          
            if($individual->id > 0){
                return $individual;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTrace());
            return null;
        }
    }

    //group
    public function createGroup($group_array){
        try{
            $user = Auth::user();
            $getgroup = Group::where('group_name',$group_array['group_name'])->where('created_by',$user['id'])->get();
    
            if($getgroup->count() == 0){
                $group = new Group;
                $group->group_name = $group_array['group_name'];
                $group->created_by = $user['id'];
                $group->save();
                if($group->id > 0){
                    $success['data'] = $group;
                    $success['code'] = 200;
                    $success['message'] = 'Group updated successfully.';
                    return $success;
                }else{
                    $success['data'] = [];
                    $success['code'] = 200;
                    $success['message'] = 'Something went wrong.... Please try again later.';
                    return $success;
                }
            }else{
                $success['data'] = [];
                $success['code'] = 400;
                $success['message'] = 'Group Already Exists';
                return $success;
            }
            
            
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    public function createGroupMember($member_array){
        try{
            $member = new GroupMember;
            $member->group_id = $member_array['group_id'];
            $member->user_id = $member_array['user_id'];;
            $member->save();
            if($member->id > 0){
                return $member;
            }else{
                return null;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    

}


?>