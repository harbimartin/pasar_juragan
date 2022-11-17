<?php

namespace App\Models\OrderTransport;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherDetailRpt extends _List {
    use HasFactory;
    protected $table = "t_truck_order_voucher_detail_rpt";
    public function voucher() {
        return $this->hasOne(OrderTransportVoucher::class, 'id', 't_truck_order_voucher_id');
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
    public function status() {
        return $this->hasOne(OrderTransportVoucherStatus::class, 'id', 'status_id');
    }
}
