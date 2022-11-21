<?php

namespace App\Models\Warehouse;

use App\Models\Company;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseContract extends Model {
    use HasFactory;
    protected $table = "t_wh_contract_tab";

    protected $fillable = [
        'juragan_barang_id',
        'juragan_gudang_id',
        'contract_no',
        'contract_desc',
        'contract_date',
        'contract_expired',
        'status'
    ];

    protected $sortable = [
        'contract_no',
        'contract_desc',
        'contract_date',
        'contract_expired',
    ];

    protected $searchable = [
        'contract_no' => 0,
        'contract_desc' => 1,
        'contract_date' => 1,
        'contract_expired' => 1,
    ];

    public function juragan_barang() {
        return $this->hasOne(Company::class, 'id', 'juragan_barang_id');
        // return $this->hasOne(Provider::class, 'id', 'juragan_barang_id');
    }
    public function juragan_gudang() {
        return $this->hasOne(Provider::class, 'id', 'juragan_gudang_id');
    }
    public function detail() {
        return $this->hasMany(WarehouseContractDetail::class, 't_wh_contract_id', 'id');
    }
    public function doc() {
        return $this->hasMany(WarehouseContractDoc::class, 't_wh_contract_id', 'id');
    }

    public function log() {
        return $this->hasMany(WarehouseContractLog::class, 't_wh_contract_id', 'id');
    }
    public function log_proposed() {
        return $this->hasMany(WarehouseContractLog::class, 't_wh_contract_id', 'id')->where('status', 'Proposed')->latest();
    }
    public function log_approved() {
        return $this->hasMany(WarehouseContractLog::class, 't_wh_contract_id', 'id')->where('status', 'Approved')->latest();
    }
}
