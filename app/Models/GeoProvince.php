<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoProvince extends _List {
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
    protected $sortable = [
        'province_code' => null,
        'province_name' => null,
        'status' => null
    ];
    protected $searchable = [
        'province_code' => 0,
        'province_name' => 1,
    ];
    protected $filterable = [
        'province_code',
        'province_name'
    ];

    public function city() {
        return $this->hasMany(GeoCity::class, 'm_province_id', 'id');
    }
}
