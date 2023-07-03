<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Jobgroups;
use App\Models\RecordType;
use App\Models\Titlepositions;
use App\Models\Regions;
use App\Models\User;
use App\Models\Individual;
use App\Models\Record;
use App\Models\Group;
use App\Models\UserLocationDetails;
use App\Models\Location;
use App\Models\EmployeeDetails;
use App\Models\RouteAssessmentForm;
use App\Models\DirectionForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Services\RecordsService;
use App\Services\PDFService;
use App\Constants\AppConstants;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RecordsService $record, PDFService $pdf)
    {
        $this->middleware('auth');
        $this->record = $record;
        $this->pdf = $pdf;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $record_type = RecordType::all();
        $record = Record::all();
        $dsa = Record::where('created_by', Auth::user()->id)->get();

        $individual = Individual::all();
        $group = Group::all();
        $users = User::get();
        $jobgroups = Jobgroups::all();
        $titlepositions = Titlepositions::all();
        $regions = Regions::all();
        $name = Record::limit(3)->get();
        $route_url = RouteAssessmentForm::limit(10)->pluck('pdf_path')->last();
        $direction_url = DirectionForm::limit(10)->pluck('pdf_path')->last();
        $currentURL = URL::current();
        $pieces = explode("/", $currentURL);
        $route_url = ($route_url != Null) ? $pieces[0] . "//" . $pieces[2] . "/" . $route_url : Null;
        $direction_url = ($direction_url != Null) ? $pieces[0] . "//" . $pieces[2] . "/" . $direction_url : Null;
        $route =   ($route_url != Null) ? Str::replace(" ", "%20", $route_url) : Null;
        $direction =   ($direction_url != Null) ? Str::replace(" ", "%20", $direction_url) : Null;
        $get_all_records = $this->record->getAllRecords();

        return view('dashboard.dashboard', compact('get_all_records', 'dsa', 'group', 'name', 'direction', 'route', 'direction_url', 'route_url', 'record', 'individual', 'users', 'jobgroups', 'titlepositions', 'regions'))->with(['sideMenu' => 'home']);
    }

    public function viewGroupList($id)
    {
        $getGroup_list = Group::where('created_by', $id)->get()->pluck('group_name');
        return response()->json($getGroup_list);
    }

    public function editProfile($id)
    {
        $getUser = User::select('users.id', 'users.name', 'users.email', 'users.address', 'employee_details.jobgroup_id', 'employee_details.titleposition_id', 'employee_details.region_id', 'employee_details.phone', 'users_location_details.location_id', 'employee_details.group_id', 'location.location', 'titlepositions.caption as job_title')
            ->leftJoin('employee_details', 'users.id', 'employee_details.user_id')
            ->leftJoin('users_location_details', 'users_location_details.user_id', 'users.id')
            ->leftJoin('titlepositions', 'titlepositions.id', 'employee_details.titleposition_id')
            ->leftJoin('location', 'users_location_details.location_id', 'location.id')->where('users.id', $id)->first();
        /*
        $user_location = UserLocationDetails::join('location','users_location_details.location_id','location.id')->where('user_id',$id)->whereNull('users_location_details.deleted_at')->get()->pluck('location')->toArray();
        $location = AppConstants::USER_EDIT_LOCATION_LIST;

        $titlepositions = Titlepositions::orderBy('caption')->where('type',1)->get()->pluck('caption')->toArray();   

        $group = Group::select('group.id','group.group_name','group.created_by')->leftJoin('titlepositions','titlepositions.caption','group.group_name')->where('group.created_by',$id)->orderBy('group.updated_at','desc')->first();
        $listOfGroup = AppConstants::USER_GROUP_LIST;
        */

        return view('settings.useredit', compact('getUser'))->with(['sideMenu' => 'home']);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => (isset($request->address)) ? $request->address :  null
            ]);

            /*
                if(!empty($request->location)){
                    $getLocation = UserLocationDetails::where('user_id', $user->id)->delete();            
                    foreach($request->location as $location)
                    { 
                        $getLocationId = Location::where('location',$location)->first();
                        if($location != "all"){                      
                            UserLocationDetails::create([
                                'user_id' =>  $user->id,
                                'location_id' =>$getLocationId->id
                            ]);
                        }
                    }  
                }
            */
            // $jobList =  Titlepositions::where('caption', $request->titleposition)->first();
            $employee = EmployeeDetails::where('user_id', $request['user_id'])->first();

            if (!$employee) {
                $result = EmployeeDetails::create([
                    'user_id' => $request['user_id'],
                    'phone' => isset($request->phoneno) ? $request->phoneno : null,
                    /*'titleposition_id' => isset($jobList->id) ? $jobList->id : null,
                     'region_id' => isset($request->region) ? $request->region : null,*/
                ]);
            } else {
                $result = EmployeeDetails::where('user_id', $request['user_id'])->update([
                    'phone' => isset($request->phoneno) ? $request->phoneno : null,
                    /* 'titleposition_id' => isset($jobList->id) ? $jobList->id : null,
                     'region_id' => isset($request->region) ? $request->region : null,*/
                ]);
            }

            /*
            $getGrouByUser =  Group::where('created_by',$request->user_id)->get();     
            if($getGrouByUser->count() == 0){
                if(isset($request->group) && $request->group){
                    $group = Group::create([
                        'created_by' => $request->user_id,
                        'group_name' => $request->group
                    ]);
                }
                
            }else{
                $group = Group::where('created_by',$request->user_id)->where('id',$request->group_id)->update([
                    'group_name' => $request->group
                ]);
            }
            */

            if ($users) {
                return redirect('home')->with(['success' => 'Profile updated successfully..']);
            } else {
                return redirect()->back()->with(["error" => "Can't able to Update your profile"]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
           
            Log::info($e->getLine());
            Log::info( $e->getTraceAsString());
            return redirect()->back()->with('error', 'Something went wrong.... Please try again later.');
        }
    }
}
