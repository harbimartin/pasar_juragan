<?php

namespace App\Models\OrderTransport;

use App\Models\Transport\Driver;
use App\Models\Transport\Truck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucher extends Model {
    use HasFactory;
    protected $table = "t_truck_order_voucher_tab";

    protected $fillable = [
        't_truck_order_id',
        'voucher_code',
        'voucher_date',
        'voucher_close_date',
        'm_truck_id',
        'm_driver_id',
        'status_id',
        'notes'
    ];

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_truck_order_id');
    }

    public function detail() {
        return $this->hasMany(OrderTransportVoucherDetail::class, 't_truck_order_voucher_id', 'id');
    }

    public function truck() {
        return $this->hasOne(Truck::class, 'id', 'm_truck_id');
    }

    public function driver() {
        return $this->hasOne(Driver::class, 'id', 'm_driver_id');
    }

    public function log() {
        return $this->hasMany(OrderTransportVoucherLog::class, 't_truck_order_voucher_id', 'id');
    }

    public function status() {
        return $this->hasOne(OrderTransportVoucherStatus::class, 'id', 'status_id');
    }
}
