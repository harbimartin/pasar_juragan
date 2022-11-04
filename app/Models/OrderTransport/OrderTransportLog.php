<?php

namespace App\Models\OrderTransport;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportLog extends Model {
    use HasFactory;
    const JURAGAN_ANGKUTAN = 0;
    const JURAGAN_BARANG = 1;
    protected $table = "t_truck_order_status_tab";

    protected $fillable = [
        't_truck_order_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(TruckContract::class, 'id', 't_truck_order_id');
    }
    public function getUserTypesAttribute() {
        return ['Juragan Angkutan', 'Juragan Barang'][$this->user_type];
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
