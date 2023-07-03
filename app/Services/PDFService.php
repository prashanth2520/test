<?php 
namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Repositories\RecordsRepository;
use App\Http\Controllers\Traits\CreateTrait;
use App\Models\DirectionForm;
use App\Models\RouteAssessmentForm;
use App\Models\Routedirection;
use PDF;


class PDFService {
    use CreateTrait;

    protected $record;


    public function __construct(RecordsRepository $record){
        $this->record = $record;
    }

    public function generatePDF($rec_id){
        $record = $this->record->getRecordsWithUser($rec_id);
        $form_path_array = array();
        $direction = array();
        $filename = '';
        $route_assessment = array();
        $form_path_array['common_path'] = 'app/public/form_pdf';
        $form_path_array['user_path'] = 'app/public/form_pdf/'.$record['created_by'];
        $form_path_array['record_path'] = 'app/public/form_pdf/'.$record['created_by'].'/'.$record['id'];
        $form_path_array['direction_path'] = 'app/public/form_pdf/'.$record['created_by'].'/'.$record['id'].'/direction';
        $form_path_array['route_assessment_path'] = 'app/public/form_pdf/'.$record['created_by'].'/'.$record['id'].'/route_assessment';

        foreach($form_path_array as $form_path){
            if(!file_exists(storage_path($form_path))){
				mkdir(storage_path($form_path));
			}
        }


        $filename .= $record['form_name'].'-'.date('Y-m-d', strtotime($record['created_at']));

        if($record['record_type'] == 1 || $record['record_type'] == 3){
            $direction = $this->record->getDirection($rec_id);
            //dd($direction);
            $filename .= '-rigroutes.pdf';
            $path = storage_path($form_path_array['direction_path']);

            $url = str_replace('app/public', 'storage', $form_path_array['direction_path']).'/'.$filename;
            $route_direction =  Routedirection::where('direction_form_id',$direction->id)->get();
            $pdf = PDF::loadView('pdf.directionform', compact('record','direction','route_direction'));
            $pdf->setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf->save($path.'/'.$filename);
            DirectionForm::where('record_id', $rec_id)->update(['pdf_path'=>$url]);
        }

        if($record['record_type'] == 2 || $record['record_type'] == 3){
            $route_assessment = $this->record->getRouteAssessment($rec_id);
       
            $filename .= '-Route Assessment.pdf';
           
            $path = storage_path($form_path_array['route_assessment_path']);
            $url = str_replace('app/public', 'storage', $form_path_array['route_assessment_path']).'/'.$filename;
            $route_direction =  Routedirection::with('getHazardBasedOnRecords','getMeasurementBasedOnRecords')->where('route_assessment_form_id',$route_assessment->id)->get();
            
           
            $pdf = PDF::loadView('pdf.routeassessmentform', compact('record','route_assessment','route_direction'));
            $pdf->setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf->save($path.'/'.$filename);
            RouteAssessmentForm::where('record_id', $rec_id)->update(['pdf_path'=>$url]);
        }

        return $rec_id;
    }
    
}


?>