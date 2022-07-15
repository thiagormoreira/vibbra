<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'channealable_id',
        'channealable_type'
    ];

    public function handler()
    {
        return $this->morphTo();
    }

    public function webPush()
    {
        return $this->hasOne(WebPush::class);
    }
}
