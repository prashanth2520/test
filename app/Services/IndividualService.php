<?php 
namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\IndividualServiceInterface;
use App\Repositories\IndividualRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\CreateTrait;
use Illuminate\Support\Facades\Auth;

class IndividualService implements IndividualServiceInterface{
    use CreateTrait;

    protected $individuals;
    
    public function __construct(IndividualRepository $individuals){
        $this->individuals = $individuals;
    }

    public function index(){
        $user = Auth::user();
        try{
            $all_individuals['users'] = $this->individuals->getIndividualsByUser($user['id']);
            $all_individuals['locations'] = $this->individuals->getIndividualsLocation();
            $all_individuals['job_title'] = $this->individuals->getJobGroup();
            return $all_individuals;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }

    public function saveIndividual($request){
        $result = 0;
        try{
            if (isset($request['indi_id']) && $request['indi_id'] != ''){
                $has_individual = $this->individuals->hasIndividual($request['indi_id']);
                if($has_individual > 0){
                    $save = $this->updateIndividual($request);
                }else{
                    $save = $this->createIndividuals($request);
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

    public function createIndividuals(array $request){
        $result = 0;
        try{
            $individual = array();
            $individual['name'] = $request['indi_name'];
            $individual['email'] = $request['indi_email'];
            $individual['location'] = $request['location'];
            $individual['group'] = $request['job_group'];
            $individual['phone'] = isset($request['indi_phone'])?$request['indi_phone']:null;
            $individual['caption'] = isset($request['caption'])?$request['caption']:null;
            $create = self::createIndividual($individual);
            if( $create != NULL ){
                $result = 1; 
            }
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return $result;
        }
        
    }

    public function updateIndividual(array $request){
        $result = 0;
        try{
            $update = $this->individuals->updateIndividual($request);
            if( $update > 0){
                $result = 1;
            }
            return $result;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTrace());
            return $result;
        }
    }

    public function viewIndividual($indi_id){
        try{
            $view = $this->individuals->viewIndividual($indi_id);
            return $view;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }

    public function viewIndividualLocationlist($indi_id){
        try{
            $view = $this->individuals->viewIndividualLocationlist($indi_id);
            return $view;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return array();
        }
    }

    
}


?>