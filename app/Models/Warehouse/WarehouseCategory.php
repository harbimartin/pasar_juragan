<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseCategory extends Model {
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
}
