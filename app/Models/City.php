<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $timestamp = false;
    protected $table = 'm_city_tab';
    protected $fillable = [
        'status',
        'city_name',
        'm_province_id'
    ];
}
