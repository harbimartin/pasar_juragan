<?php

namespace App\Models\Transport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckContractDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_truck_contract_detail_rpt";

    protected $fillable = [];

    public function contract() {
        return $this->hasOne(TruckContract::class, 'id', 't_truck_contract_id');
    }
}
