<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewbornRecord extends Model
{
    protected $fillable = [
        'delivery_id',
        'baby_gender',
        'birth_weight_kg',
        'birth_height_cm'
    ];

    protected function casts(): array
    {
        return [
            'birth_weight_kg' => 'decimal:2',
            'birth_height_cm' => 'decimal:1'
        ];
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}