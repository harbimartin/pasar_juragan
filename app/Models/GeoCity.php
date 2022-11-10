<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoCity extends _List {
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
        'status',
    ];
    protected $sortable = [
        'city_name' => null,
        'province' => ['m_province_tab', 'm_province_id', 'province_name'],
        'status' => null
    ];
    protected $searchable = [
        'city_name' => 0,
        'province' => 'province_name',
    ];
    protected $filterable = [
        'city_name',
    ];

    public function province() {
        return $this->hasOne(GeoProvince::class, 'id', 'm_province_id');
    }
}
