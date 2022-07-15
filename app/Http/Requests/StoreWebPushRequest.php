<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebPushRequest extends FormRequest
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
            'settings.site.name' => 'required|string|max:255',
            'settings.site.address' => 'required|string|max:255',
            'settings.site.url_icon' => 'required|string|max:255',
            'settings.allow_notification.message_text' => 'required|string|max:255',
            'settings.allow_notification.allow_button_text' => 'required|string|max:255',
            'settings.allow_notification.deny_button_text' => 'required|string|max:255',
            'settings.welcome_notification.message_title' => 'required|string|max:255',
            'settings.welcome_notification.message_text' => 'required|string|max:255',
            'settings.welcome_notification.enable_url_redirect' => 'required|boolean',
            'settings.welcome_notification.url_redirect' => 'required|string|max:255',
        ];
    }
}
