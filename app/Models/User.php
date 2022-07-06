<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'location_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'location_id',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'location'
    ];

    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function getLocationAttribute()
    {
        return $this->location()->first();
    }
}
