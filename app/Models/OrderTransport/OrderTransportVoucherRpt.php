<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherRpt extends Model {
    use HasFactory;
    protected $table = "t_truck_order_voucher_rpt";

    protected $fillable = [
        't_truck_order_id',
        'plate_no',
        'driver_name',
    ];

    public function order() {
        return $this->hasOne(OrderTransport::class, 'id', 't_truck_order_id');
    }

    public function detail() {
        return $this->hasMany(OrderTransportVoucherDetail::class, 't_truck_order_voucher_detail_id', 'id');
    }

    public function loading() {
        return $this->hasOne(LoadingAddress::class, 'id', 'm_loading_address_id');
    }

    public function unloading() {
        return $this->hasOne(UnloadingAddress::class, 'id', 'm_loading_address_id');
    }
}
