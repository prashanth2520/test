<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordFormRequest extends FormRequest
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

    public function withValidator($validator)
    {
        if ($validator->fails()){
            return redirect('records')->with('error_code', "add")->withInput()->withErrors($validator);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->session()->flash('error_code', 'add');

        return [
            'record_name' => 'required|max:50',
            'record_type' => 'required',
            'rig_name' => 'required|max:50',
            'rig_no' => 'required|max:50',
            'job_no' => 'nullable|max:50'
        ];
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
        ];
    }
}
