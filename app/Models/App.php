<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'token'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'id', 'name', 'token'
    ];

    protected $appends = [
        'app_id', 'app_name', 'app_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAppNameAttribute()
    {
        return $this->name;
    }

    public function getAppTokenAttribute()
    {
        return $this->token;
    }

    public function getAppIdAttribute()
    {
        return $this->id;
    }
}
