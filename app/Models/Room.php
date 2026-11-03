<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
    ];

    public function deliveries()
    {
    return $this->hasMany(Delivery::class, 'room_id');
    }
};
