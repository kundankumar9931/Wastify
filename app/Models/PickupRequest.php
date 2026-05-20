<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hostel_name', 'room_number', 'waste_type', 'preferred_time', 'note', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
