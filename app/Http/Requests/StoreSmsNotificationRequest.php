<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSmsNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "phone_number" => "required|array",
            "message_text" => "required|string|min:3|max:255",
            "app_id" => "required|exists:apps,id",
        ];
    }
}
