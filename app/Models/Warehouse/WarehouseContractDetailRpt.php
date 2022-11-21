<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseContractDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_wh_contract_detail_rpt";

    public function contract() {
        return $this->hasOne(WarehouseContract::class, 'id', 't_wh_contract_id');
    }
}
