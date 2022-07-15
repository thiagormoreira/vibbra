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
        return $this->morphOne(Channel::class, 'channelable');
    }

    public function channel()
    {
        return $this->channelable()->first();
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
