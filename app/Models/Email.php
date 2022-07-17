<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    public static function transformData(Email $emailConfig)
    {
        return [
            'settings' => [
                'server' => [
                    'smtp_name' => $emailConfig->smtp_name,
                    'smtp_port' => $emailConfig->smtp_port,
                    'smpt_login' => $emailConfig->smpt_login,
                    'smpt_password' => $emailConfig->smpt_password,
                ],
                'sender' => [
                    'name' => $emailConfig->sender_name,
                    'email' => $emailConfig->sender_email,
                ],
                'email_templates' => [
                    'name' => 'template_name',
                    'uri' => 'template_uri',
                ]
            ]
        ];
    }
}
