<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'city',
        'state',
        'zip_code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
