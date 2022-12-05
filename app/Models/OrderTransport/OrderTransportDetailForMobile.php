<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportDetailForMobile extends Model {
    use HasFactory;
    protected $table = 't_truck_order_voucher_detail_mobile';

    public function foto() {
        return $this->hasMany(VoucherTabFile::class, 't_truck_order_voucher_id', 'header_id');
    }
}
