<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentContractDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_he_contract_detail_rpt";

    public function contract() {
        return $this->hasOne(HeavyEquipmentContract::class, 'id', 't_he_contract_id');
    }
}
