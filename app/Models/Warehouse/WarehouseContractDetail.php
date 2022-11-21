<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseContractDetail extends Model {
    use HasFactory;
    protected $table = "t_wh_contract_detail_tab";

    protected $fillable = [
        't_wh_contract_id',
        'm_warehouse_id',
        'price_per_meter_daily',
        'price_per_meter_monthly',
        'status'
    ];

    public function contract() {
        return $this->hasOne(WarehouseContract::class, 'id', 't_wh_contract_id');
    }
    public function warehouse() {
        return $this->hasOne(Warehouse::class, 'id', 'm_warehouse_id');
    }
}
