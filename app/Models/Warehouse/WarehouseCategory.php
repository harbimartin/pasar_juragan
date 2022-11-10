<?php

namespace App\Models\Warehouse;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseCategory extends _List {
    use HasFactory;
    protected $table = "m_wh_category_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wh_category',
        'wh_category_desc',
        'status'
    ];
    protected $sortable = [
        'wh_category' => null,
        'wh_category_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'wh_category' => 0,
        'wh_category_desc' => 1,
    ];
    protected $filterable = [
        'wh_category',
        'wh_category_desc',
    ];
}
