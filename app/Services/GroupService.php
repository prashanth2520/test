<?php 
namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\GroupServiceInterface;
use App\Repositories\GroupRepository;
use App\Http\Controllers\Traits\CreateTrait;
use App\Repositories\IndividualRepository;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;

class GroupService implements GroupServiceInterface{
    use CreateTrait;

    protected $groups;
    
    public function __construct(GroupRepository $groups, IndividualRepository $individuals){
        $this->groups = $groups;
    }
    
    public function saveGroup(array $request){
        $result = 0;
        try{
            if (isset($request['group_id']) && $request['group_id'] != ''){
                $has_group = $this->groups->hasGroup($request['group_id']);
                if($has_group > 0){
                    $save = $this->updateGroup($request);
                }else{
                    $save = $this->createGroups($request);
                }                
                $success['data'] = $save['data'];
                $success['code'] =  $save['code'];
                $success['message'] =  $save['message'];
                return $success;
            }else{
                $success['data'] = [];
                $success['code'] =  400;
                $success['message'] =  'Something went wrong.... Please try again later.';
                return $success;
            }
           return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function createGroups(array $request){
        $result = 0;
        try{
            $group = array();
            $group['group_name'] = $request['group_name'];
            $create_group = self::createGroup($group);
            return $create_group;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function updateGroup(array $request){
        $result = 0; 
        try{
            $group = array();
            $getGroup = Group::where('id',$request['group_id'])->first();
            $group['group_name'] = isset($request['group_name'])?$request['group_name']:$getGroup->group_name;
            $update_group =  $this->groups->updateGroup($request['group_id'], $group);

            if(!empty($request['individuals'])){
                $this->groups->updateGroupMembers($request['group_id'], $request['individuals']);
            }

            $success['data'] = $update_group;
            $success['code'] =  200;
            $success['message'] = 'Group updated successfully.';

            $result = ($update_group > 0) ? 1 : 0;
            return 1;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function deleteGroup(int $group_id){
        $result = 0;
        try{
            $delete_group =  $this->groups->deleteGroup($group_id);
            return $delete_group?1:0;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function addMembers(int $group_id, array $group_member){
        $result = 0;
        
        try{
            if(!empty($group_member)){
               foreach($group_member as $indi_id){
                    $has_member = $this->groups->hasMember($group_id, $indi_id);
                    if($has_member == 0){
                        $member_array = array();
                        $member_array['individual_id'] =  $indi_id;
                        $member_array['group_id'] =  $group_id;
                        $add_member = self::createGroupMember($member_array);
                    }
               } 
               $result = 1;
            }
            
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function getGroupByUser($user_id){
        $group=array();
        try{
            $group =  $this->groups->getGroupByUser($user_id);
            return $group;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $group;
        }
    }
    

    public function viewGroup($group_id){
        try{
            $view = $this->groups->viewGroup($group_id);
            return $view;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }


    public function removeMember($member_id){
        try{
            return $this->groups->removeMember($member_id);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }

    public function individualsList(){
        try{
            return $this->groups->individualsList();
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }
    public function groupsList(){
        try{
            return $this->groups->groupsList();
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }
   
}


?>