<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportDetailRpt extends Model {
    use HasFactory;
    protected $table = "t_truck_order_detail_rpt";

    // protected $fillable = [
    //     'origin_name',
    //     'destination_name',
    //     'truck_type_desc',
    //     'commodity_name',
    //     'picking_date',
    //     'due_date'
    // ];
}
