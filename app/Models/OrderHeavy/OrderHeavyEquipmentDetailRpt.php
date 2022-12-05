<?php

namespace App\Models\OrderHeavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeavyEquipmentDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_heavy_order_detail_rpt";

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_heavy_order_id');
    }

    public function contract() {
        return $this->hasOne(TruckContractDetail::class, 'id', 't_heavy_contract_detail_id');
    }

    public function contract_rpt() {
        return $this->hasOne(TruckContractDetailRpt::class, 'id', 't_heavy_contract_detail_id');
    }
}
