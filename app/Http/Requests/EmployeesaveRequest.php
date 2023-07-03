<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class EmployeesaveRequest extends FormRequest
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
            return redirect('employee')->with('error_code', "add")->withInput()->withErrors($validator);
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
        $type = isset($request['emp_id']) && $request['emp_id'] == 0 ? 'add' : 'edit';
        switch($type) {
            case "add": 
                
                $validate=array('emp_name' => 'required|min:1|max:255',
                'emp_email' => 'required|min:1|max:255|unique:users,email|email',
                'emp_password' => 'required|min:8|max:15');
                break;

            case "edit": 
                $validate=array('emp_name' => 'required|min:1|max:25',
                'emp_email' => 'required|min:1|max:25|email');
               
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
            'emp_email.unique' => 'This email is already exists.',
            'emp_email.email' => 'This email is in incorrect format.',
            'emp_password.min' => 'Password should be in 8-15 charecters.',
            'emp_password.max' => 'Password should be in 8-15 charecters.'
        ];
    }
}
