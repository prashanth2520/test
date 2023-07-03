<?php 
namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\EmployeeServiceInterface;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\CreateTrait;


class EmployeeService implements EmployeeServiceInterface{
    use CreateTrait;

    protected $employee;
    
    public function __construct(EmployeeRepository $employee){
        $this->employee = $employee;
    }

    public function index(){
        try{
            $all_employees = $this->employee->index();
            return $all_employees;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }

    public function saveEmployee($request){
        
        $result = 0;
        try{
            if (isset($request['emp_id']) && $request['emp_id'] != ''){
                $has_employee = $this->employee->hasEmployee($request['emp_id']);
                if($has_employee > 0){
                    $save = $this->updateEmployee($request);
                }else{
                    $save = $this->createEmployee($request);
                }
                $result = ($save > 0) ? 1 : 0;
            }else{
                $result = 0;
            }
           return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function createEmployee(array $request){
        $result = 0;
        try{
            $user = array();
            $user['name'] = $request['emp_name'];
            $user['email'] = $request['emp_email'];
            $user['password'] = $request['emp_password'];
 
            $user['user_role'] = 2;
            $create_user = self::createUsers($user);
            if($create_user->id > 0){
                $employee_details = array();
                $employee_details['emp_id'] = $request['emp_no'];
                $employee_details['region_id'] = isset($request['region'])?$request['region']:null;
                $employee_details['phone'] = isset($request['phoneno'])?$request['phoneno']:null;
                $employee_details['jobgroup_id'] = isset($request['jobgroup'])?$request['jobgroup']:null;    
                $employee_details['titleposition_id'] = isset($request['titleposition'])?$request['titleposition']:null;
                $employee_details['user_id'] = $create_user->id;
                $create_employee_details = self::createEmployeeDetails($employee_details);
            }
            if( $create_user!=NULL && $create_employee_details!=NULL ){
                $result = 1; 
            }
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
        
    }

    public function updateEmployee(array $request){
        $result = 0;
        try{
            $update_user = $this->employee->updateUser($request);
            $update_empdet = $this->employee->updateEmployeeDet($request);
            if($update_user > 0 && $update_empdet > 0){
                $result = 1;
            }
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
    }

    public function viewEmployee($emp_id){
        try{
            $save = $this->employee->viewEmployee($emp_id);
            return $save;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }
    
}


?>