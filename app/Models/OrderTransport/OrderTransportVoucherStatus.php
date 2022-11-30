<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherStatus extends Model {
    use HasFactory;
    public $table = 'm_truck_order_voucher_status_tab';
    protected $fillable = ['isactive'];
}
