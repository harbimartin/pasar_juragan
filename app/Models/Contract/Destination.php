<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model {
    use HasFactory;
    protected $table = "m_destination_tab";

    protected $fillable = [
        'destination_name',
        'destination_desc',
        'status'
    ];
}
