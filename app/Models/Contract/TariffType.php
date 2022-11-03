<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffType extends Model {
    use HasFactory;
    protected $table = "m_tariff_type_tab";

    protected $fillable = [
        'tariff_name',
        'tariff_desc',
        'status'
    ];
}
