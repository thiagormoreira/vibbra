<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_title',
        'message_text',
        'app_id',
        'channel_id',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }
}
