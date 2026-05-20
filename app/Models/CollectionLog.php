<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionLog extends Model
{
    protected $fillable = [
        'household_id',
        'truck_id',
        'employee_id',
        'collected_at',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
