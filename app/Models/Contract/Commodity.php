<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model {
    use HasFactory;
    protected $table = "m_commodity_tab";

    protected $fillable = [
        'commodity_name',
        'commodity_desc',
        'status'
    ];
}
