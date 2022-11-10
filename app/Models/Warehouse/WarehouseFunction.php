<?php

namespace App\Models\Warehouse;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseFunction extends _List {
    use HasFactory;
    protected $table = "m_wh_function_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wh_function',
        'wh_function_desc',
        'status'
    ];
    protected $sortable = [
        'wh_function' => null,
        'wh_function_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'wh_function' => 0,
        'wh_function_desc' => 1,
    ];
    protected $filterable = [
        'wh_function',
        'wh_function_desc',
    ];
}
