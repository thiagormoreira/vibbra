<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable =[
        'smtp_name',
        'smtp_port',
        'smtp_login',
        'smtp_password',
        'sender_name',
        'sender_email',
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

    public static function transformData(Email $emailConfig)
    {
        return [
            'settings' => [
                'server' => [
                    'smtp_name' => $emailConfig->smtp_name,
                    'smtp_port' => $emailConfig->smtp_port,
                    'user_login' => $emailConfig->smtp_login,
                    'user_password' => $emailConfig->smtp_password,
                ],
                'sender' => [
                    'name' => $emailConfig->sender_name,
                    'email' => $emailConfig->sender_email,
                ],
                'email_templates' => [
                    [
                        'name' => 'template_name 1',
                        'uri' => 'template_uri 1',
                    ],
                    [
                        'name' => 'template_name 2',
                        'uri' => 'template_uri 2',
                    ],
                    [
                        'name' => 'template_name 3',
                        'uri' => 'template_uri 3',
                    ]
                ]
            ]
        ];
    }

    public static function formatData(array $data)
    {
        return [
            'smtp_name' => $data['settings']['server']['smtp_name'],
            'smtp_port' => $data['settings']['server']['smtp_port'],
            'smtp_login' => $data['settings']['server']['user_login'],
            'smtp_password' => $data['settings']['server']['user_password'],
            'sender_name' => $data['settings']['sender']['name'],
            'sender_email' => $data['settings']['sender']['email'],
        ];
    }
}
