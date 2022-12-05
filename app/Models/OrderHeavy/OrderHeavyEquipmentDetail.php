<?php

namespace App\Models\OrderHeavy;

use App\Models\HeavyEquipment\HeavyEquipmentContractDetail;
use App\Models\HeavyEquipment\HeavyEquipmentContractDetailRpt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeavyEquipmentDetail extends Model {
    use HasFactory;
    protected $table = "t_he_order_detail_tab";

    protected $fillable = [
        't_he_order_id',
        't_he_contract_detail_id',
        'start_project',
        'wh_large',
        'flag_daily_monthly',
        'long_used',
        'order_note',
        'status'
    ];

    public function order() {
        return $this->hasOne(OrderHeavyEquipment::class, 'id', 't_he_order_id');
    }

    public function contract() {
        return $this->hasOne(HeavyEquipmentContractDetail::class, 'id', 't_he_contract_detail_id');
    }

    public function contract_rpt() {
        return $this->hasOne(HeavyEquipmentContractDetailRpt::class, 'id', 't_he_contract_detail_id');
    }
}
