<?php

namespace App\Models\OrderHeavy;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeavyEquipmentLog extends Model {
    use HasFactory;
    const JURAGAN_GUDANG = 0;
    const JURAGAN_BARANG = 1;
    protected $table = "t_heavy_order_status_tab";

    protected $fillable = [
        't_heavy_order_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(TruckContract::class, 'id', 't_heavy_order_id');
    }
    public function getUserTypesAttribute() {
        return ['Juragan Gudang', 'Juragan Barang'][$this->user_type];
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
