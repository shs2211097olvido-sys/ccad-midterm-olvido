<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    protected $fillable = [
        'mother_name',
        'mother_id_card'
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}