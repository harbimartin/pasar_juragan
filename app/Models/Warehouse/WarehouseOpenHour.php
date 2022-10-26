<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseOpenHour extends Model {
    use HasFactory;
    protected $table = "m_warehouse_open_hour_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_warehouse_id',
        'open_day',
        'open_hour',
        'close_hour',
        'status'
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function (WarehouseOpenHour $openhour) {
            $openhour->status = 1;
        });
    }
}
