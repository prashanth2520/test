<?php 
namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;
use App\Models\Individual;
use App\Models\UserLocationDetails;
use App\Models\Location;
use App\Models\Titlepositions;
use App\Repositories\Interfaces\IndividualRepositoryInterface;
use App\Http\Controllers\Traits\CreateTrait;
use App\Constants\AppConstants;

class IndividualRepository implements IndividualRepositoryInterface{

    use CreateTrait;

    public function getIndividualsByUser(int $user_id){
        return Individual::select('individuals.id','individuals.name','individuals.email','individuals.phone','individuals.caption','location.location','group.group_name')        
        ->leftJoin('users_location_details','users_location_details.individual_user_id','individuals.id')
        ->leftJoin('location','users_location_details.location_id','location.id')
        ->leftJoin('group',function ($join){
            $join->on('individuals.id','group.individual_user_id')
            ->whereNull('group.deleted_at');
        })->where('individuals.belongs_to', $user_id)->orderBy('individuals.created_at','DESC')->groupBy('individuals.email')->get();
    }
    
    public function hasIndividual(int $indi_id){
        return Individual::where('id', $indi_id)->count();
    }
    
    public function updateIndividual(array $request){
 
        $individuals = Individual::where('id', $request['indi_id'])->update([
            'name' => $request['indi_name'],
            'email' => $request['indi_email'],
            'belongs_to' =>  Auth::user()->id,
            'phone' => $request['phone'],
            'caption' => isset($request['caption'])?$request['caption']:null
        ]);

        if(isset($request['job_group']) && ($request['job_group'] != 'others')){   
            $getpostion = Group::where('id',$request['group_id'])->where('individual_user_id',$request['indi_id'])->first();
            if(!$getpostion){
                Group::create([
                    'created_by' => null,
                    'individual_user_id'=>$request['indi_id'],
                    'group_name'=> $request['job_group']
                ]);
            }else{
                Group::where('individual_user_id',$request['indi_id'])->update([
                    'created_by' => null,
                    'individual_user_id'=>$request['indi_id'],
                    'group_name'=>$request['job_group']
                ]);
            }         
        }else{
            Group::where('id',$request['group_id'])->delete();
        }
     
        if(!empty($request['location'])){         
            UserLocationDetails::where('individual_user_id',$request['indi_id'])->delete();
            foreach($request['location'] as $location){
                if(isset($location) && ($location != 'others')){
                    $getLocation = Location::where('location',$location)->first();   
                    if(!$getLocation){
                        $new_location = Location::create([
                            'location' => $location,
                        ]);
                        UserLocationDetails::create([
                            'individual_user_id'=> $request['indi_id'],
                            'location_id' =>  $new_location->id
                        ]);

                    }else{
                        $userlocation = UserLocationDetails::where('location_id',$getLocation->id)->where('individual_user_id',$request['indi_id'])->first();
                    
                        if(!$userlocation){
                            UserLocationDetails::create([
                                'individual_user_id'=>$request['indi_id'],
                                'location_id' => $getLocation->id
                            ]);
                        }
                    }
                }
            }
        }
        return $individuals;
    }

    public function viewIndividual(int $indi_id) {
        $details['user_details'] = Individual::select('individuals.id','individuals.name','individuals.caption','individuals.phone','individuals.email','group.id as group_id','group.group_name','location.location')
        ->leftJoin('users_location_details','users_location_details.individual_user_id','individuals.id')
        ->leftJoin('location','users_location_details.location_id','location.id')
        ->leftJoin('group',function ($join){
            $join->on('individuals.id','group.individual_user_id')
            ->whereNull('group.deleted_at');
        })
        ->where('individuals.id', $indi_id)->first();

        $details['location'] = UserLocationDetails::leftJoin('location','users_location_details.location_id','location.id')->where('users_location_details.individual_user_id',$indi_id)->get()->pluck('location');    

        return  $details;
    }

    public function getIndividualsLocation(){
        return AppConstants::USER_EDIT_LOCATION_LIST;
    }

    public function getJobGroup()
    {
       return Titlepositions::where('type',1)->get();
    }
    
    public function viewIndividualLocationlist($indi_id){
        return UserLocationDetails::join('location','users_location_details.location_id','location.id')->where('users_location_details.individual_user_id',$indi_id)->get()->pluck('location');
    }
}
