<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'trade_for',
        'location_id',
        'urgency',
        'limit_date',
        'photos',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
