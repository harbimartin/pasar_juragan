<?php

namespace App\Models\OrderWarehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWarehouseDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_wh_order_detail_rpt";

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_wh_order_id');
    }

    public function contract() {
        return $this->hasOne(TruckContractDetail::class, 'id', 't_wh_contract_detail_id');
    }

    public function contract_rpt() {
        return $this->hasOne(TruckContractDetailRpt::class, 'id', 't_wh_contract_detail_id');
    }
}
