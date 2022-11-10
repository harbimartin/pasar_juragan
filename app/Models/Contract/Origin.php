<?php

namespace App\Models\Contract;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends _List {
    use HasFactory;
    protected $table = "m_origin_tab";

    protected $fillable = [
        'origin_name',
        'origin_desc',
        'status'
    ];
    protected $sortable = [
        'origin_name' => null,
        'origin_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'origin_name' => 0,
        'origin_desc' => 1,
    ];
    protected $filterable = [
        'origin_name',
        'origin_desc',
    ];
}
