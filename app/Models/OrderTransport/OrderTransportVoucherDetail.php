<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherDetail extends Model {
    use HasFactory;
    protected $table = "t_truck_order_voucher_detail_tab";

    protected $fillable = [
        't_truck_order_voucher_id',
        't_truck_order_detail_id',
        'cargo_code',
        'tonnage',
        'pcs',
        'notes'
    ];

    public function voucher() {
        return $this->hasOne(OrderTransportVoucher::class, 'id', 't_truck_order_voucher_detail_id');
    }

    public function tariff() {
        return $this->hasOne(OrderTransportDetail::class, 'id', 't_truck_order_detail_id');
    }
    public function voucher_rpt() {
        return $this->hasOne(OrderTransportVoucherRpt::class, 'id', 't_truck_order_voucher_id');
    }
    public function order_detail_rpt() {
        return $this->hasOne(OrderTransportDetailRpt::class, 'id', 't_truck_order_detail_id');
    }
}
