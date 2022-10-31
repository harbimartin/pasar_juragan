<?php

namespace App\Models\Transport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckType extends Model
{
    use HasFactory;
    protected $table = "m_truck_type_tab";

    protected $fillable = [
        'truck_type',
        'truck_type_desc',
        'status'
    ];
}
