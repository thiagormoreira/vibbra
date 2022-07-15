<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'channelable_id',
        'channelable_type',
        'status'
    ];

    public function handler()
    {
        return $this->channelable_type::find($this->channelable_id);
    }

    public function webPush()
    {
        return $this->hasOne(WebPush::class);
    }
}
