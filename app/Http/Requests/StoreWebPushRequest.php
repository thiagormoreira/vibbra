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
            'settings.site.name' => 'required|string|min:3|max:255',
            'settings.site.address' => 'required|string|min:3|max:255',
            'settings.site.url_icon' => 'required|string|min:3|max:255',
            'settings.allow_notification.message_text' => 'required|string|min:3|max:255',
            'settings.allow_notification.allow_button_text' => 'required|string|min:3|max:255',
            'settings.allow_notification.deny_button_text' => 'required|string|min:3|max:255',
            'settings.welcome_notification.message_title' => 'required|string|min:3|max:255',
            'settings.welcome_notification.message_text' => 'required|string|min:3|max:255',
            'settings.welcome_notification.enable_url_redirect' => 'required|boolean',
            'settings.welcome_notification.url_redirect' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'settings.site.name.required' => 'The site name is required.',
            'settings.site.name.min' => 'The site name must be at least 3 characters.',
            'settings.site.name.max' => 'The site name must be at most 255 characters.',

            'settings.site.address.required' => 'The site address is required.',
            'settings.site.address.min' => 'The site address must be at least 3 characters.',
            'settings.site.address.max' => 'The site address must be at most 255 characters.',

            'settings.site.url_icon.required' => 'The site icon url is required.',
            'settings.site.url_icon.min' => 'The site icon url must be at least 3 characters.',
            'settings.site.url_icon.max' => 'The site icon url must be at most 255 characters.',

            'settings.allow_notification.message_text.required' => 'The allow notification message text is required.',
            'settings.allow_notification.message_text.min' => 'The allow notification message text must be at least 3 characters.',
            'settings.allow_notification.message_text.max' => 'The allow notification message text must be at most 255 characters.',

            'settings.allow_notification.allow_button_text.required' => 'The allow notification allow button text is required.',
            'settings.allow_notification.allow_button_text.min' => 'The allow notification allow button text must be at least 3 characters.',
            'settings.allow_notification.allow_button_text.max' => 'The allow notification allow button text must be at most 255 characters.',

            'settings.allow_notification.deny_button_text.required' => 'The allow notification deny button text is required.',
            'settings.allow_notification.deny_button_text.min' => 'The allow notification deny button text must be at least 3 characters.',
            'settings.allow_notification.deny_button_text.max' => 'The allow notification deny button text must be at most 255 characters.',

            'settings.welcome_notification.message_title.required' => 'The welcome notification message title is required.',
            'settings.welcome_notification.message_title.min' => 'The welcome notification message title must be at least 3 characters.',
            'settings.welcome_notification.message_title.max' => 'The welcome notification message title must be at most 255 characters.',

            'settings.welcome_notification.message_text.required' => 'The welcome notification message text is required.',
            'settings.welcome_notification.message_text.min' => 'The welcome notification message text must be at least 3 characters.',
            'settings.welcome_notification.message_text.max' => 'The welcome notification message text must be at most 255 characters.',

            'settings.welcome_notification.enable_url_redirect.required' => 'The welcome notification enable url redirect is required.',
            'settings.welcome_notification.enable_url_redirect.boolean' => 'The welcome notification enable url redirect must be a boolean.',

            'settings.welcome_notification.url_redirect.required' => 'The welcome notification url redirect is required.',
            'settings.welcome_notification.url_redirect.min' => 'The welcome notification url redirect must be at least 3 characters.',
            'settings.welcome_notification.url_redirect.max' => 'The welcome notification url redirect must be at most 255 characters.',

        ];
    }
}
