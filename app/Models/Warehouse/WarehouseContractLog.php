<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseContractLog extends Model {
    use HasFactory;
    const JURAGAN_GUDANG = 0;
    const JURAGAN_BARANG = 1;
    protected $table = "t_wh_contract_status_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_wh_contract_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(WarehouseContract::class, 'id', 't_wh_contract_id');
    }
    public function getUserTypesAttribute() {
        return ['Juragan Angkutan', 'Juragan Barang'][$this->user_type];
    }
    public function doc() {
        return $this->hasMany(WarehouseContractDoc::class, 't_wh_contract_id', 't_wh_contract_id');
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
