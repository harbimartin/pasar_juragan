<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentContractDoc extends Model {
    use HasFactory;
    protected $table = "t_heavy_contract_doc_tab";

    protected $fillable = [
        't_heavy_contract_id',
        'doc_name',
        'doc_desc',
        'doc_attachment',
        'status'
    ];
}
