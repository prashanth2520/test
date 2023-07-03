<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupsaveRequest extends FormRequest
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
        $type = isset($request['group_id']) && $request['group_id'] == 0 ? 'add' : 'edit';
        if ($validator->fails()){
            return redirect('groups')->with('error_code', $type)->withInput()->withErrors($validator);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this->all();
        $validate = array();
        $type = isset($request['group_id']) && $request['group_id'] ? 'add' : 'edit';
        switch($type) {
            case "add": 
                $validate=array('group_name' => 'required|max:25');
                break;
            case "edit": 
                $validate=array('group_name' => 'required|max:25');
                break;

       }

       return $validate;
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
            'min' => 'This field should have minimum :min charecter(s).',
            'max' => 'This field should have maximum :max charecter(s).',
        ];
    }
}
