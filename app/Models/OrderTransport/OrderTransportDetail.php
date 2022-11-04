<?php

namespace App\Models\OrderTransport;

use App\Models\Item\LoadingAddress;
use App\Models\Item\UnloadingAddress;
use App\Models\Transport\TruckContractDetailRpt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportDetail extends Model {
    use HasFactory;
    protected $table = "t_truck_order_detail_tab";

    protected $fillable = [
        't_truck_order_id',
        't_truck_contract_detail_id',
        'picking_date',
        'due_date',
        'tonage',
        'm_loading_address_id',
        'm_unloading_address_id',
        'estimate_truck_required',
        'order_note',
        'status'
    ];

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_truck_order_id');
    }

    public function contract() {
        return $this->hasOne(TruckContractDetail::class, 'id', 't_truck_contract_detail_id');
    }

    public function contract_rpt() {
        return $this->hasOne(TruckContractDetailRpt::class, 'id', 't_truck_contract_detail_id');
    }

    public function loading() {
        return $this->hasOne(LoadingAddress::class, 'id', 'm_loading_address_id');
    }

    public function unloading() {
        return $this->hasOne(UnloadingAddress::class, 'id', 'm_loading_address_id');
    }
}
