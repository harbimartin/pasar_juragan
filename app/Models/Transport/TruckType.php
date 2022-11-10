<?php

namespace App\Models\Transport;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckType extends _List {
    use HasFactory;
    protected $table = "m_truck_type_tab";

    protected $fillable = [
        'truck_type',
        'truck_type_desc',
        'status'
    ];
    protected $sortable = [
        'truck_type' => null,
        'truck_type_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'truck_type' => 0,
        'truck_type_desc' => 1,
    ];
    protected $filterable = [
        'truck_type',
        'truck_type_desc',
    ];
}
