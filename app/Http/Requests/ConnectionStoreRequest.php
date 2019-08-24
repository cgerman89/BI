<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectionStoreRequest extends FormRequest
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
        return [
            'collecction_id' => 'required',
            'host'    => 'required',
            'username'=> 'required',
            'dbpassword' => 'required',
            'dbname'  => 'required',
            'port' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'collecction_id.required' => 'DBMS REQUIRED',
            'host.required'  => 'HOST REQUIRED',
            'username.required'  => 'USERNAME REQUIRED',
            'dbpassword.required'  => 'PASSWORD REQUIRED',
            'dbname.required'  => 'DBNAME REQUIRED',
            'port.required'  => 'PORT REQUIRED',
            'port.integer'  => 'PORT IS NUMERIC',
        ];
    }
}
