<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'settings.server.smtp_name' => 'required|string|min:3|max:255',
            'settings.server.smtp_port' => 'required|integer|min:1|max:65535',
            'settings.server.user_login' => 'required|string|min:3|max:255',
            'settings.server.user_password' => 'required|string|min:3|max:255',
            'settings.sender.name' => 'required|string|min:3|max:255',
            'settings.sender.email' => 'required|email|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'settings.server.smtp_name.required' => 'The smtp name is required.',
            'settings.server.smtp_name.min' => 'The smtp name must be at least 3 characters.',
            'settings.server.smtp_name.max' => 'The smtp name must be at most 255 characters.',

            'settings.server.smtp_port.required' => 'The smtp port is required.',
            'settings.server.smtp_port.integer' => 'The smtp port must be an integer.',
            'settings.server.smtp_port.min' => 'The smtp port must be at least 1.',
            'settings.server.smtp_port.max' => 'The smtp port must be at most 65535.',

            'settings.server.user_login.required' => 'The smtp login is required.',
            'settings.server.user_login.min' => 'The smtp login must be at least 3 characters.',
            'settings.server.user_login.max' => 'The smtp login must be at most 255 characters.',

            'settings.server.user_password.required' => 'The smtp password is required.',
            'settings.server.user_password.min' => 'The smtp password must be at least 3 characters.',
            'settings.server.user_password.max' => 'The smtp password must be at most 255 characters.',

            'settings.sender.name.required' => 'The sender name is required.',
            'settings.sender.name.min' => 'The sender name must be at least 3 characters.',
            'settings.sender.name.max' => 'The sender name must be at most 255 characters.',

            'settings.sender.email.required' => 'The sender email is required.',
            'settings.sender.email.min' => 'The sender email must be at least 3 characters.',
            'settings.sender.email.max' => 'The sender email must be at most 255 characters.',
            'settings.sender.email.email' => 'The sender email must be a valid email address.',
        ];
    }
}
