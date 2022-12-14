<?php

namespace App\Models\Heavy;

use App\Models\_List;
use App\Models\Image;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipment extends _List {
    use HasFactory;
    public $timestamps = true;
    protected $table = "m_heavy_equipment_tab";

    protected $fillable = [
        'm_provider_id',
        'm_heavy_equipment_type_id',
        'equipment_code',
        'equipment_brand',
        'equipment_desc',
        'equipment_attachment',
        'operational_weight',
        'status'
    ];

    protected $sortable = [
        'equipment_code',
        'equipment_brand',
        'status'
    ];

    protected $filterable = [
        'type' => 'm_heavy_equipment_type_id',
    ];

    protected $searchable = [
        'equipment_code' => 0,
        'equipment_brand' => 1,
        'equipment_desc' => 1,
        'operational_weight' => 1
    ];

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 'm_provider_id');
    }

    public function image() {
        return $this->hasMany(Image::class, 'm_code_id', 'id')->where('image_type', Provider::HEAVY_EQUIPMENT);
    }

    public function type() {
        return $this->hasOne(HeavyEquipmentType::class, 'id', 'm_heavy_equipment_type_id');
    }
}
