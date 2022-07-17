<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    public static function transformData(Sms $smsConfig)
    {
        return [
            'settings' => [
                'sms_provider' => [
                    'name' => $smsConfig->provider_name,
                    'login' => $smsConfig->provider_login,
                    'password' => $smsConfig->provider_password,
                ]
            ]
        ];
    }
}
