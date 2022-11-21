<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseContractDoc extends Model {
    use HasFactory;
    protected $table = "t_wh_contract_doc_tab";

    protected $fillable = [
        't_wh_contract_id',
        'doc_name',
        'doc_desc',
        'doc_attachment',
        'status'
    ];
}
