<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "audience_segments" => "required|array",
            "message_title" => "required|string|min:3|max:255",
            "message_text" => "required|string|min:3|max:255",
            "icon_url" => "nullable|url|min:3|max:255",
            "redirect_url" => "nullable|url|min:3|max:255",
            "app_id" => "required|exists:apps,id",
        ];
    }
}
