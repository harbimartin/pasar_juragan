<?php

namespace App\Models\Transport;

use App\Models\Contract\Commodity;
use App\Models\Contract\Destination;
use App\Models\Contract\Origin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckContractDetail extends Model {
    use HasFactory;
    protected $table = "t_truck_contract_detail_tab";

    protected $fillable = [
        't_truck_contract_id',
        'm_origin_id',
        'm_destination_id',
        'm_truck_type_id',
        'm_commodity_id',
        'price_per_ton',
        'price_per_rit',
        'minimum_ton',
        'status'
    ];

    public function contract() {
        return $this->hasOne(TruckContract::class, 'id', 't_truck_contract_id');
    }
    public function origin() {
        return $this->hasOne(Origin::class, 'id', 'm_origin_id');
    }
    public function destination() {
        return $this->hasOne(Destination::class, 'id', 'm_destination_id');
    }
    public function truck_type() {
        return $this->hasOne(TruckType::class, 'id', 'm_truck_type_id');
    }
    public function commodity() {
        return $this->hasOne(Commodity::class, 'id', 'm_commodity_id');
    }
}
