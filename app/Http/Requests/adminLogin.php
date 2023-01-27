<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminLogin extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'username' => 'required|max:50',
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'username.required'=>'username alanı zorunludur',
            'username.max'=>'maximum 50 karakter girebilirsin'            
        ];
    }

}
