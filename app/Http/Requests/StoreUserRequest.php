<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
