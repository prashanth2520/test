<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individual;
use App\Services\IndividualService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\IndividualsaveRequest;
use App\Models\GroupMember;

class IndividualsController extends Controller
{
    protected $individuals;
    
    public function __construct(IndividualService $individuals){
        $this->individuals = $individuals;
    }
    
    public function index(){
        $all_individuals = array();
        try{
            $getData = $this->individuals->index();
            $all_individuals =  $getData['users'];
            $all_locations = $getData['locations'];
            $job_group = $getData['job_title'];
            return view('individuals.view', compact('all_individuals','all_locations','job_group'))->with(['sideMenu'=>'individuals']);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function saveIndividual(IndividualsaveRequest $request){

        try{
            $save = $this->individuals->saveIndividual($request->all());
            if($save > 0){
                return redirect('individuals')->with('success', 'Individual updated successfully.');
            }else{
                return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function viewIndividualJobList($indi_id)
    {
        try{
            $individual = $this->individuals->viewIndividualLocationlist($indi_id);
            return response()->json($individual);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function viewIndividual($indi_id){
        try{
            $individual = $this->individuals->viewIndividual($indi_id);
            return response()->json($individual);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
        }
        
    }

    public function deleteIndividual($emp_id){
        try{
            $delete = GroupMember::where('individual_id', $emp_id)->delete();
            $delete = Individual::where('id', $emp_id)->delete();
            if($delete > 0){
                return redirect('individuals')->with('success', 'Individual Deleted successfully.');
            }else{
                return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('individuals')->with('error', 'Something went wrong.... Please try again later.');
        }
        
    }

}
