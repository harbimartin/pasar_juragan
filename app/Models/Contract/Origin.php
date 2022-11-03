<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model {
    use HasFactory;
    protected $table = "m_origin_tab";

    protected $fillable = [
        'origin_name',
        'origin_desc',
        'status'
    ];
}
