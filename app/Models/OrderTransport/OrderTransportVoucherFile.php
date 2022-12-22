<?php

namespace App\Models\OrderTransport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportVoucherFile extends Model {
    use HasFactory;
    protected $table = "t_truck_order_voucher_file_tab";
    protected $fillable = [
        't_truck_order_voucher_id', 'file_name', 'file_url', 'status', 'created_at', 'updated_at'
    ];

    protected $appends = ["url"];
    protected $hidden = ["file_name"];

    public function getUrlAttribute() {
        // return "http://". $_SERVER['SERVER_NAME']."/pasar_juragan/" ."storage/foto/". $this->file_url;
        // return route('get-image', ['foto_epod', $this->file_url]);
        return "http://192.168.0.25/pasar_juragan/api/v1/get:image/foto_epod/" . $this->file_url;
    }
}
