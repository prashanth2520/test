<?php 
namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Http\Controllers\Traits\CreateTrait;
use App\Models\Individual;

class GroupRepository implements GroupRepositoryInterface{
    
    
    public function hasGroup(int $group_id){
        return Group::where('id', $group_id)->count();
    }

    public function hasMember(int $group_id, int $indi_id){
        return GroupMember::where('group_id', $group_id)->where('individual_id', $indi_id)->get();
    }

    public function getGroupByUser(int $user_id){
        return Group::with(['groupMembers'])->where('created_by', $user_id)->orderBy('id','desc')->get();
    }

    public function getGroupMembersByGrp(int $group_id){
        return GroupMember::with(['groupMembers'])->where('group_id', $group_id)->get();
    }

    public function updateGroup(int $group_id, array $group_array){
        return Group::where('id', $group_id)->update($group_array);
    }

    public function deleteGroup(int $group_id){
        return Group::where('id',$group_id)->delete();
    }

    public function viewGroup(int $group_id) {
        return Group::with(['groupMembers','groupMembers.individuals'])->where('id', $group_id)->orderBy('created_at', 'desc')->get();
    }

    public function removeMember(int $member_id) {
        return GroupMember::where('id',$member_id)->delete();
    }

    public function individualsList() {
        return Individual::all();
    }

    public function groupsList() {
        return Group::all();
    }

    public function updateGroupMembers(int $group_id, array $individuals)
    {
        
        foreach($individuals as $individual){

            if(GroupMember::where('group_id',$group_id)->where('individual_id',$individual)->count() == 0){
                    $group = new GroupMember;
                    $group->group_id = $group_id;
                    $group->individual_id = $individual;
                    $group->save();
            }

        }

        return true;
    }
    
}



?>