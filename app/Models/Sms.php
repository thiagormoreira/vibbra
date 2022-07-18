<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_name',
        'provider_login',
        'provider_password',
        'app_id',
    ];

    public function channelable()
    {
        return $this->morphOne(Channel::class, 'channelable', 'channelable_type', 'channelable_id');
    }

    public function channel()
    {
        return $this->channelable()->firstOrCreate([
            'app_id' => $this->app_id,
        ]);
    }

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

    public static function formatData(array $data)
    {
        return [
            'provider_name' => $data['settings']['sms_provider']['name'],
            'provider_login' => $data['settings']['sms_provider']['login'],
            'provider_password' => $data['settings']['sms_provider']['password'],
        ];
    }
}
