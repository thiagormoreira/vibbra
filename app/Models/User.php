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
        'address_id',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'company',
        'company_id',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'company_name',
        'company_address'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompanyAddressAttribute()
    {
        return $this->company->address;
    }

    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }
}
