<?php

namespace App\Models\Contract;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends _List {
    use HasFactory;
    protected $table = "m_destination_tab";

    protected $fillable = [
        'destination_name',
        'destination_desc',
        'status'
    ];
    protected $sortable = [
        'destination_name' => null,
        'destination_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'destination_name' => 0,
        'destination_desc' => 1,
    ];
    protected $filterable = [
        'destination_name',
        'destination_desc',
    ];
}
