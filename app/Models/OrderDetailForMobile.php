<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailForMobile extends Model
{
    use HasFactory;
    protected $table = 't_truck_order_voucher_detail_mobile';

    public function foto() {
        return $this->hasMany(VoucherTabFile::class, 't_truck_order_voucher_id', 'header_id');
    }
}
