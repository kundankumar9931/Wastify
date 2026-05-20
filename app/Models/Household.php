<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'household_name',
        'location',
        'truck_id',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
