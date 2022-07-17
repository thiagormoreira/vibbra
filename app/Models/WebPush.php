<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPush extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_address',
        'site_url_icon',
        'allow_notification_message_text',
        'allow_notification_allow_button_text',
        'allow_notification_deny_button_text',
        'welcome_notification_message_title',
        'welcome_notification_message_text',
        'welcome_notification_enable_url_redirect',
        'welcome_notification_url_redirect',
        'app_id'
    ];

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }

    public function channelable()
    {
        return $this->morphOne(Channel::class, 'channelable', 'channelable_type', 'channelable_id');
    }

    public function channel()
    {
        return $this->channelable()->first();
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public static function transformData(WebPush $webPush)
    {
        return [
            'settings' => [
                'site' => [
                    'name' => $webPush->site_name,
                    'address' => $webPush->site_address,
                    'url_icon' => $webPush->site_url_icon,
                ],
                'allow_notification' => [
                    'message_text' => $webPush->allow_notification_message_text,
                    'allow_button_text' => $webPush->allow_notification_allow_button_text,
                    'deny_button_text' => $webPush->allow_notification_deny_button_text,
                ],
                'welcome_notification' => [
                    'message_title' => $webPush->welcome_notification_message_title,
                    'message_text' => $webPush->welcome_notification_message_text,
                    'enable_url_redirect' => $webPush->welcome_notification_enable_url_redirect ? true : false,
                    'url_redirect' => $webPush->welcome_notification_url_redirect,
                ]
            ]
        ];
    }

    public static function formatData(array $data)
    {
        return [
            'site_name' => $data['settings']['site']['name'],
            'site_address' => $data['settings']['site']['address'],
            'site_url_icon' => $data['settings']['site']['url_icon'],
            'allow_notification_message_text' => $data['settings']['allow_notification']['message_text'],
            'allow_notification_allow_button_text' => $data['settings']['allow_notification']['allow_button_text'],
            'allow_notification_deny_button_text' => $data['settings']['allow_notification']['deny_button_text'],
            'welcome_notification_message_title' => $data['settings']['welcome_notification']['message_title'],
            'welcome_notification_message_text' => $data['settings']['welcome_notification']['message_text'],
            'welcome_notification_enable_url_redirect' => $data['settings']['welcome_notification']['enable_url_redirect'] ? true : false,
            'welcome_notification_url_redirect' => $data['settings']['welcome_notification']['url_redirect'],
        ];
    }
}
