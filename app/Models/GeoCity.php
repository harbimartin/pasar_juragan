<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoCity extends Model {
    use HasFactory;
    protected $table = "m_city_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_province_id',
        'city_name',
        'status'
    ];

    public function province() {
        return $this->hasOne(GeoProvince::class, 'id', 'm_province_id');
    }
}
