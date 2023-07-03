<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RecordsRepository;
use App\Services\RecordsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Record;
use App\Models\Individual;
use App\Models\Group;

class UserController extends Controller
{
    protected $user, $record;
    
    public function __construct(UserService $user, RecordsService $record){
        $this->user = $user;
        $this->record = $record;
    }

    //User Login
     public function login(Request $request)
    {
        return $this->user->login($request);
    }

    //forgot password
    public function forgotPassword(Request $request)
    {
        return $this->user->forgotPassword($request);
    }

    //change password
    public function changePassword(Request $request)
    {
        return $this->user->changePassword($request);
    }

    //profile Update
    public function updateProfile(Request $request)
    {
        return $this->user->updateProfile($request);
    }

    //home
    public function home()
    {
        return $this->user->home();
    }
 
    //get profile
    public function getProfile()
    {
        return $this->user->getProfile();
    }

    
    //search route
    public function searchRoute()
    {
        try{
            // $get_records = $this->record->getAllRecords();
            
            $get_all_records = Record::leftjoin('direction_forms', 'direction_forms.record_id', 'records.id')
            ->leftjoin('route_assessment_forms', 'route_assessment_forms.record_id', 'records.id')
            ->whereNotNull('direction_forms.pdf_path')
            ->orWhereNotNull('route_assessment_forms.pdf_path')
            ->select('records.id', 'records.form_name', 'records.rig_name', 'records.rig_no', 'records.job_no', 'direction_forms.pdf_path', 'route_assessment_forms.pdf_path', 'records.created_at',
            'direction_forms.pdf_path AS directection_pdf',
            'route_assessment_forms.pdf_path AS route_assessment_pdf')
            // DB::raw('IF(direction_forms.pdf_path IS NOT NULL, direction_forms.pdf_path, "") AS directection_pdf'),
            // DB::raw('IF(route_assessment_forms.pdf_path IS NOT NULL, route_assessment_forms.pdf_path, "") AS route_assessment_pdf'))
            ->orderBy('records.created_at', 'desc')->get();


            return response()->json([
                'status' => true,
                'data' => $get_all_records,
            ],200);
    
        }catch(\Exception $e){
            Log::error([
                "function"  => "SearchRoute",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function createGroup(Request $request){
        return $this->user->createGroup($request);
    }

    public function records_listing(Request $request){
            try{
            $service_records = Record::with('userDetails','directionForm','routeAssessmentForm')->paginate();
            $count = count($service_records);
            return response()->json([
                'status' => true,
                'count' => $count,
                'data' => $service_records,
            ],200);

        }catch(\Exception $e){
            Log::error([
                "function"  => "RecordsListing",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    
    public function individuals_listing(Request $request){
        try{
        $individual_records = Individual::paginate();
        $count = count($individual_records);
        return response()->json([
            'status' => true,
            'count' => $count,
            'data' => $individual_records,
        ],200);

    }catch(\Exception $e){
        Log::error([
            "function"  => "IndividualListing",
            "error"     => $e->getMessage(),
            "line"      => $e->getLine(),
            "trace"     => $e->getTraceAsString()
        ]);
        return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
    }
}

public function groups_listing(){
    try{
        $userID = Auth::user()->id;
        $group_records = DB::table('group')->where('created_by', $userID)->get();
            
    $count = count($group_records);
    return response()->json([
        'status' => true,
        'count' => $count,
        'group_records' => $group_records,
    ],200);

}catch(\Exception $e){
    Log::error([
        "function"  => "GroupListing",
        "error"     => $e->getMessage(),
        "line"      => $e->getLine(),
        "trace"     => $e->getTraceAsString()
    ]);
    return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
}
}
}