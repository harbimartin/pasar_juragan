<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherLog extends Model {
    use HasFactory;
    public $table = 't_truck_order_voucher_status_tab';
    protected $fillable = [
        't_truck_order_voucher_id',
        'status_id',
        'status_note',
        'user_id',
        'driver_id'
    ];
    public function status() {
        return $this->hasOne(OrderTransportVoucherStatus::class, 'id', 'status_id');
    }
}
