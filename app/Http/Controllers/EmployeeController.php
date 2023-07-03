<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Jobgroups;
use App\Models\Titlepositions;
use App\Models\Regions;
use App\Http\Requests\EmployeesaveRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{

    protected $employee;
    
    public function __construct(EmployeeService $employee){
        $this->employee = $employee;
    }
    
    public function index(){
        $all_employees = $this->employee->index();
        $jobgroups = Jobgroups::all();
        $titlepositions = Titlepositions::where('type',1)->get();
        $regions = Regions::all();
        return view('employee.view', compact('all_employees','jobgroups','titlepositions','regions'))->with(['sideMenu'=>'employee']);
    }

    public function saveEmployee(EmployeesaveRequest $request){
        
        try{
            $save = $this->employee->saveEmployee($request->all());
            if($save > 0){
                return redirect('employee')->with('success', 'Employee updated successfully.');
            }else{
                return redirect('employee')->with('error', 'Something went wrong.... Please try again later.');
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('employee')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function saveEmployeedashboard(EmployeesaveRequest $request){
    
        try{
            $save = $this->employee->saveEmployee($request->all());
            if($save > 0){
                return redirect('employee')->with('success', 'Employee updated successfully.');
            }else{
                return redirect('employee')->with('error', 'Something went wrong.... Please try again later.');
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect('dashboard')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function viewEmployee($emp_id){
        $employee = $this->employee->viewEmployee($emp_id);
        return response()->json($employee);
    }

    public function deleteEmployee($emp_id){
        $employee_delete = User::where('id', $emp_id)->delete();
        if($employee_delete > 0){
            return redirect('employee')->with('success', 'Employee Deleted successfully.');
        }else{
            return redirect('employee')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

}
