<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordDirectionRouteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this->all();
        $direction_validation = array();
        $route_assess_validation = array();
        $validation = array();
        $type = isset($request['rec_type']) && $request['rec_type'] > 0 ? $request['rec_type'] : '';

        $record_validation = array(
            'rigName' => 'required|max:50',
            'rigNo' => 'required|max:50',
            'jobNo' => 'nullable|max:50',
        );
        if($type == 1 || $type == 3 ){
            $direction_validation = array(
                'addNewLocation' => 'max:50',
                'olName' => 'max:50',
                // 'olSteps' => 'required',
                // 'nlFromolName' => 'required|max:50',
                // 'nlFromolSteps' => 'required',
                // 'nlName' => 'required|max:50',
                // 'labelName.*'=>'required',
                
               

            );
        }

        if($type == 2 || $type == 3 ){
            
            $route_assess_validation = array(
                'dateTime' => 'required',
                // 'jobNo' => 'required|max:10',
                // 'rigName' => 'required|max:50',
                'operator' => 'nullable|max:50',
                'operatorEmail' => 'nullable|email|max:50',
                // 'oldLoc'=>'required',
                // 'oldLocgps'=>'required',
                'olLatitude'=>'required',
                'olLongitude'=>'required',
                // 'newLoc'=>'required',
                // 'newLocgps'=>'required',
                'newLatitude'=>'required',
                'newLongitude'=>'required',
                // 'totalMiles'=>'required',
                // 'rigNo' => 'max:10',
                'aef' => 'max:25',
                'rigManager' => 'max:50',
                'rigPhone' => 'max:15',
                'rigEmail' => 'email|max:50',

            );
        }
        $validation = array_merge($direction_validation,  $route_assess_validation);
        $validation = array_merge( $record_validation, $validation);

        return $validation;
        
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'This field is required.',
            'min' => 'This field should have minimum :min charecter(s).',
            'max' => 'This field should have maximum :max charecter(s).',
            'email' => 'This field is in invalid format.'
        ];
    }
}
