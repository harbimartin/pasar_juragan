<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoProvince extends Model {
    use HasFactory;
    protected $table = "m_province_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'province_code',
        'province_name',
        // 'iso2',
        'status'
    ];

    public function city() {
        return $this->hasMany(GeoCity::class, 'm_province_id', 'id');
    }
}
