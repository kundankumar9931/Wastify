<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartBinRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'location_type', 'specific_location', 'quantity', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
