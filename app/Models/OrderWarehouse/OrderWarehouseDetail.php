<?php

namespace App\Models\OrderWarehouse;

use App\Models\Warehouse\WarehouseContractDetail;
use App\Models\Warehouse\WarehouseContractDetailRpt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWarehouseDetail extends Model {
    use HasFactory;
    protected $table = "t_wh_order_detail_tab";

    protected $fillable = [
        't_wh_order_id',
        't_wh_contract_detail_id',
        'start_project',
        'wh_large',
        'flag_daily_monthly',
        'long_used',
        'order_note',
        'status'
    ];

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_wh_order_id');
    }

    public function contract() {
        return $this->hasOne(WarehouseContractDetail::class, 'id', 't_wh_contract_detail_id');
    }

    public function contract_rpt() {
        return $this->hasOne(WarehouseContractDetailRpt::class, 'id', 't_wh_contract_detail_id');
    }
}
