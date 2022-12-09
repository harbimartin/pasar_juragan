<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentContractLog extends Model {
    use HasFactory;
    const JURAGAN_ALATBERAT = 0;
    const JURAGAN_BARANG = 1;
    protected $table = "t_he_contract_status_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_he_contract_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(HeavyEquipmentContract::class, 'id', 't_he_contract_id');
    }
    public function getUserTypesAttribute() {
        return ['Juragan Angkutan', 'Juragan Barang'][$this->user_type];
    }
    public function doc() {
        return $this->hasMany(HeavyEquipmentContractDoc::class, 't_he_contract_id', 't_he_contract_id');
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
