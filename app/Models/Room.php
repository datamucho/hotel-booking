<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'room_id';
    
    protected $fillable = [
        'room_type',
        'price_per_night',
        'availability_status',
        'floor_number'
    ];
}