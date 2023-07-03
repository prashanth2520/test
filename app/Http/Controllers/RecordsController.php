<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\InputType;

use App\Models\RecordType;
use App\Services\PDFService;
use Illuminate\Http\Request;
use App\Models\Routedirection;
use App\Services\RecordsService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RecordFormRequest;
use App\Http\Requests\RecordDirectionRouteFormRequest;

class RecordsController extends Controller
{
    protected $record, $pdf;


    public function __construct(RecordsService $record, PDFService $pdf)
    {
        $this->record = $record;
        $this->pdf = $pdf;
    }

    public function index()
    {
        $get_all_records = $this->record->getAllRecords();
        $record_type = RecordType::all();
        return view('records.view', compact('get_all_records', 'record_type'))->with(['sideMenu' => 'records']);
    }

    public function editRecords(int $rec_id  )
    {
        
        try {
            $record =  $this->record->getRecordsWithUser($rec_id);
            $direction = array();
            $route_assessment = array();
            $direction_routes = array();
            $assessment_routes = array();
            $selectedTemperatureOptionValues=[];
            if ($record['record_type'] == 1 || $record['record_type'] == 3) {
                $direction = $this->record->getDirection($rec_id);
                if(isset($direction)) {
                 $direction_routes =  Routedirection::where('direction_form_id',$direction->id)->get();
                }
            }
            if ($record['record_type'] == 2 || $record['record_type'] == 3) {
                $route_assessment = $this->record->getRouteAssessment($rec_id);
                if(isset($route_assessment)) {
                    if($route_assessment->temperatureOption->isNotEmpty()){
                        foreach($route_assessment->temperatureOption as $temperatureOptionValues){
                            $selectedTemperatureOptionValues[]=$temperatureOptionValues->temperature_id;
                        }
                    }
                    $assessment_routes =  Routedirection::where('route_assessment_form_id',$route_assessment->id)->get();
                }
                
            }
                $getRigType =$this->record->getRidType();
                $getMoveType =$this->record->getMoveType();
                $getRigStatus =$this->record->getRigStatus();
                $temperature=$this->record->getTemperature();
                $hazardList=$this->record->getHazardList();
                $measurementList = $this->record->getMeasurementList();
    

            $input_array = InputType::all();
            return view('records.add', compact('record', 'direction', 'route_assessment', 'input_array','direction_routes','assessment_routes','getRigType','getMoveType','getRigStatus','temperature','selectedTemperatureOptionValues','hazardList','measurementList'))->with(['sideMenu' => 'records']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function deleteRecords(int $rec_id)
    {
        try {
            $record_delete = Record::where('id', $rec_id)->delete();
            if ($record_delete > 0) {
                return redirect('records')->with('success', 'Record Deleted successfully.');
            } else {
                return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function saveRecord(RecordFormRequest $request)
    {
    
        try {
            $save = 0;
            $save = $this->record->saveRecord($request->all());
            if ($save > 0) {
                return redirect('records/edit/' . $save);
            } else {
                return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function saveFormRecords(RecordDirectionRouteFormRequest $request)
    {      
        try {
            $save = 0;
            $save = $this->record->saveFormRecords($request->all());
            if ($save > 0) {
                return redirect('records')->with('success', 'Updated successfully.');
            } else {
                return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('records/edit/' . $request['rec_id'])->with('error', 'Something went wrong.... Please try again later.');
        }
    }

    public function generatePDF(int $rec_id)
    {
        $pdf = $this->pdf->generatePDF($rec_id);
        return $pdf;
    }

    public function sharePdf(Request $request)
    {
        try {
            $share = 0;
            $share = $this->record->sharePDF($request->all());
            if ($share > 0) {
                return redirect('records')->with('success', 'Mail sent successfully..!');
            } else {
                return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('records')->with('error', 'Something went wrong.... Please try again later.');
        }
    }
}
