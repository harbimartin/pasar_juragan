<?php

namespace App\Models\Transport;

use App\Models\_List;
use App\Models\Company;
use App\Models\Contract\TruckLog;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TruckContract extends _List {
    use HasFactory;
    protected $table = "t_truck_contract_tab";

    protected $fillable = [
        'juragan_barang_id',
        'juragan_angkutan_id',
        'contract_no',
        'contract_date',
        'contract_expired',
        'status'
    ];

    protected $sortable = [
        'contract_no',
        'contract_date',
        'contract_expired',
    ];

    protected $searchable = [
        'contract_no' => 0,
        'contract_date' => 1,
        'contract_expired' => 1,
    ];

    public function juragan_barang() {
        return $this->hasOne(Company::class, 'id', 'juragan_barang_id');
        // return $this->hasOne(Provider::class, 'id', 'juragan_barang_id');
    }
    public function juragan_angkutan() {
        return $this->hasOne(Provider::class, 'id', 'juragan_angkutan_id');
    }
    public function detail() {
        return $this->hasMany(TruckContractDetail::class, 't_truck_contract_id', 'id');
    }
    public function doc() {
        return $this->hasMany(TruckContractDoc::class, 't_truck_contract_id', 'id');
    }

    public function log() {
        return $this->hasMany(TruckContractLog::class, 't_truck_contract_id', 'id');
    }
    public function log_proposed(){
        return $this->hasMany(TruckContractLog::class, 't_truck_contract_id', 'id')->where('status', 'Proposed')->latest();
    }
}
