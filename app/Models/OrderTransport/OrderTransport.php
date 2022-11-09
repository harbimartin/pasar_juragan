<?php

namespace App\Models\OrderTransport;

use App\Models\Transport\TruckContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransport extends Model {
    use HasFactory;
    protected $table = "t_truck_order_tab";

    protected $fillable = [
        'to_no',
        'to_desc',
        'to_date',
        't_truck_contract_id',
        'status'
    ];

    public function detail() {
        return $this->hasMany(OrderTransportDetail::class, 't_truck_order_id', 'id');
    }
    public function contract() {
        return $this->hasOne(TruckContract::class, 'id', 't_truck_contract_id');
    }
    public function log() {
        return $this->hasMany(OrderTransportLog::class, 't_truck_order_id', 'id');
    }
    public function log_proposed() {
        return $this->hasMany(OrderTransportLog::class, 't_truck_order_id', 'id')->where('status', 'Proposed')->latest();
    }
    public function log_approved() {
        return $this->hasMany(OrderTransportLog::class, 't_truck_order_id', 'id')->where('status', 'Approved')->latest();
    }
    public function voucher() {
        return $this->hasMany(OrderTransportVoucher::class, 't_truck_order_id', 'id');
    }
}
