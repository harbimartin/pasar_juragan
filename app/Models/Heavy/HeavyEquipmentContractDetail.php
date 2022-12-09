<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentContractDetail extends Model {
    use HasFactory;
    protected $table = "t_he_contract_detail_tab";

    protected $fillable = [
        't_he_contract_id',
        'm_heavy_equipment_id',
        'price',
        'status'
    ];

    public function contract() {
        return $this->hasOne(HeavyEquipmentContract::class, 'id', 't_he_contract_id');
    }
    public function a2b() {
        return $this->hasOne(HeavyEquipment::class, 'id', 'm_heavy_equipment_id');
    }
}
