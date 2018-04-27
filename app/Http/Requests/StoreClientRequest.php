<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'email|required|unique:clients',
            'password'=> 'required|min:5',
            'phone'=>'required|regex:/(01)[0-9]{9}/',
            'country'=>'required',
            'gender'=>'required',
            'avatar'=>'required|mimes:jpeg,png'
            
        ];
    }
}
