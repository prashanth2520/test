<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class IndividualsaveRequest extends FormRequest
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
        $request = $this->all();
        $type = isset($request['indi_id']) && $request['indi_id'] == 0 ? 'add' : 'edit';
        if ($validator->fails()){
            return redirect('individuals')->with('error_code', $type)->withInput()->withErrors($validator);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'indi_name' => 'required|min:1|max:25',
            'indi_email' => 'required|min:1|max:50|email'
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // use trans instead on Lang 
        return [
            'required' => 'This field is required.',
            'email' => 'This email is in incorrect format.',
            'min' => 'This field should have minimum :min charecter(s).',
            'max' => 'This field should have maximum :max charecter(s).',
        ];
    }
}
