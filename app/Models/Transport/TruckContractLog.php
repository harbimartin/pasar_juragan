<?php

namespace App\Models\Transport;

use App\Models\Transport\TruckContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckContractLog extends Model {
    use HasFactory;
    const JURAGAN_ANGKUTAN = 0;
    const JURAGAN_BARANG = 0;
    protected $table = "t_truck_contract_status_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_truck_contract_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(TruckContract::class, 'id', 't_truck_contract_id');
    }
    public function getUserTypesAttribute(){
        return ['Juragan Angkutan', 'Juragan Barang'][$this->user_type];
    }
    public function doc() {
        return $this->hasMany(TruckContractDoc::class, 't_truck_contract_id', 't_truck_contract_id');
    }
}
