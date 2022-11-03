<?php

namespace App\Models\Transport;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckContractDoc extends Model {
    use HasFactory;
    protected $table = "t_truck_contract_doc_tab";

    protected $fillable = [
        't_truck_contract_id',
        'doc_name',
        'doc_desc',
        'doc_attachment',
        'status'
    ];
}
