<?php 
namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\EmployeeDetails;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Http\Controllers\Traits\CreateTrait;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    use CreateTrait;

    public function index()
    {
        $all_employees = array();
        try{
            $has_employees = User::where('user_role', 2)->count();
            if($has_employees > 0){
                //dd($has_employees);
                $all_employees = User::with('userEmployeeDetails')->where('user_role', 2)->orderBy('created_at', 'desc')->get();
            }
            return $all_employees;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $all_employees;
        }
        
    }
    
    public function hasEmployee(int $emp_id)
    {
        $has_employee = 0;
        try{
            $has_employee = User::where('id', $emp_id)->where('user_role', 2)->count();
            return $has_employee;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $has_employee;
        }
    }
    
    public function updateUser(array $request)
    {
        $result = 0;
        try{
            $result= User::where('id', $request['emp_id'])->where('user_role', 2)->update([
                'name' => $request['emp_name'],
            ]);
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function updateEmployeeDet(array $request)
    {
        $result = 0;
        try{
            $result= EmployeeDetails::where('user_id', $request['emp_id'])->update([
                'emp_id' => $request['emp_no'],
                'jobgroup_id' => isset($request['jobgroup'])?$request['jobgroup']:null,
                'phone' => isset($request['phoneno'])?$request['phoneno']:null,
                'titleposition_id' =>isset($request['titleposition'])?$request['titleposition']:null,
                'region_id' => isset($request['region'])?$request['region']:null
            ]);
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function viewEmployee(int $emp_id)
    {
        $employee = array();
        try{
            $has_employee = User::where('user_role', 2)->where('id',$emp_id)->count();
            if($has_employee > 0){
                //dd($has_employees);
                $employee = User::with('userEmployeeDetails')->where('user_role', 2)->where('id',$emp_id)->first();
            }
            return $employee;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $employee;
        }
        
    }
    
}



?>