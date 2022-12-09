<?php

namespace App\Models\OrderHeavy;

use App\Models\Heavy\HeavyEquipmentContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeavyEquipment extends Model {
    use HasFactory;
    protected $table = "t_he_order_tab";

    protected $fillable = [
        'heo_no',
        'heo_desc',
        'heo_date',
        't_he_contract_id',
        'status'
    ];

    public function detail() {
        return $this->hasMany(OrderHeavyEquipmentDetail::class, 't_he_order_id', 'id');
    }
    public function contract() {
        return $this->hasOne(HeavyEquipmentContract::class, 'id', 't_he_contract_id');
    }
    public function log() {
        return $this->hasMany(OrderHeavyEquipmentLog::class, 't_he_order_id', 'id');
    }
    public function log_proposed() {
        return $this->hasMany(OrderHeavyEquipmentLog::class, 't_he_order_id', 'id')->where('status', 'Proposed')->latest();
    }
    public function log_approved() {
        return $this->hasMany(OrderHeavyEquipmentLog::class, 't_he_order_id', 'id')->where('status', 'Approved')->latest();
    }
}
