<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user');
        return [
            'national_id' => 'required|unique:users,national_id,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'name' => 'required',
            'password' => 'min:6',
            'avatar' => 'mimes:jpeg,png'
        ];
    }
}