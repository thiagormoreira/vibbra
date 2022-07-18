<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSmsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'settings.sms_provider.name' => 'required|string|min:3|max:255',
            'settings.sms_provider.login' => 'required|string|min:3|max:255',
            'settings.sms_provider.password' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'settings.sms_provider.name.required' => 'The sms provider name is required.',
            'settings.sms_provider.name.min' => 'The sms provider name must be at least 3 characters.',
            'settings.sms_provider.name.max' => 'The sms provider name must be at most 255 characters.',

            'settings.sms_provider.login.required' => 'The sms provider login is required.',
            'settings.sms_provider.login.min' => 'The sms provider login must be at least 3 characters.',
            'settings.sms_provider.login.max' => 'The sms provider login must be at most 255 characters.',

            'settings.sms_provider.password.required' => 'The sms provider password is required.',
            'settings.sms_provider.password.min' => 'The sms provider password must be at least 3 characters.',
            'settings.sms_provider.password.max' => 'The sms provider password must be at most 255 characters.',
        ];
    }
}
