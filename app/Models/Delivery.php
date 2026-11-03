<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'mother_id',
        'obstetrician_id',
        'room_id',
        'delivery_type',
        'birth_datetime',
        'delivery_fee',
        'discharge_status'
    ];

    protected function casts(): array
    {
        return [
            'birth_datetime' => 'datetime',
            'delivery_fee' => 'decimal:2'
        ];
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function obstetrician()
    {
        return $this->belongsTo(Obstetrician::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function newbornRecord()
    {
        return $this->hasOne(NewbornRecord::class);
    }
}