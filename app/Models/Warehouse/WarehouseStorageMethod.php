<?php

namespace App\Models\Warehouse;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStorageMethod extends _List {
    use HasFactory;
    protected $table = "m_wh_storage_methode_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wh_storage_methode',
        'wh_storage_methode_desc',
        'status'
    ];
    protected $sortable = [
        'wh_storage_methode' => null,
        'wh_storage_methode_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'wh_storage_methode' => 0,
        'wh_storage_methode_desc' => 1,
    ];
    protected $filterable = [
        'wh_storage_methode',
        'wh_storage_methode_desc',
    ];
}
