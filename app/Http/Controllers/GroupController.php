<?php

namespace App\Http\Controllers;

use App\Repositories\IndividualRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GroupsaveRequest;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $group, $individuals;


    public function __construct(GroupService $group, IndividualRepository $individuals){
        $this->group = $group;
        $this->individuals = $individuals;
    }

    public function index(){
        $user = Auth::user();
        $all_groups = $this->group->getGroupByUser($user['id']);
        $individuals = $this->individuals->getIndividualsByUser($user['id']);
        return view('groups.view', compact('individuals', 'all_groups'))->with(['sideMenu'=>'all_groups']);
    }

    public function saveGroup(GroupsaveRequest $request){
        
        try{
            $save = $this->group->saveGroup($request->all());
          
            if($save['code'] == 200 ){
                return redirect('groups')->with('success', $save['message']);
            }else{
                return redirect('groups')->with('error', $save['message']);
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('groups')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function edit($group_id)
    {
        $all_groups = Group::find($group_id);
        return view('groups', compact('all_groups'));
    }

    public function deleteGroup($group_id)
    {
        try{
            $delete_group = $this->group->deleteGroup($group_id);
            return redirect('groups')->with('success', 'Group deleted successfully.');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('groups')->with('error', 'Something went wrong.... Please try again later.');
        }
        
    }

    public function viewGroup($group_id){
       
        try{
            $group = $this->group->viewGroup($group_id);
            return response()->json($group);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'error in listing member'],500);
        }
        
    }

    public function updateGroup(Request $request)
    {
        try{
            $this->group->updateGroup($request->all());
            return redirect('groups')->with('success', 'Group Updated Successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('groups')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function removeMember($member_id)
    {
        try{
            $this->group->removeMember($member_id);
            return response()->json(['success' => 'member removed successfully'],200);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'error in removing member'],500);
        }
    }

    public function getIndividuals()
    {
        $user = Auth::user();
        try{
            /*if($user['user_role'] == 1){
                $individuals = $this->group->individualsList();
            }else{*/
                $individuals = $this->individuals->getIndividualsByUser($user['id']);
            //}
            return response()->json($individuals,200);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'error in listing individuals'],500);
        }
    }

    public function getGroups()
    {
        $user = Auth::user();
        try{
            /*if($user['user_role'] == 1){
                $groups = $this->group->groupsList();
            }else{*/
                $groups = $this->group->getGroupByUser($user['id']);
            //}
            return response()->json($groups,200);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'error in listing groups'],500);
        }
    }
    

}
