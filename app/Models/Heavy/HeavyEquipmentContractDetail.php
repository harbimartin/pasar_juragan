<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentContractDetail extends Model {
    use HasFactory;
    protected $table = "t_he_contract_detail_tab";

    protected $fillable = [
        't_he_contract_id',
        'm_warehouse_id',
        'price_per_meter_daily',
        'price_per_meter_monthly',
        'status'
    ];

    public function contract() {
        return $this->hasOne(HeavyEquipmentContract::class, 'id', 't_he_contract_id');
    }
    public function warehouse() {
        return $this->hasOne(HeavyEquipment::class, 'id', 'm_warehouse_id');
    }
}
