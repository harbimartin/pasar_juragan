<?php

namespace App\Models\Heavy;

use App\Models\_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentType extends _List {
    use HasFactory;
    protected $table = "m_heavy_equipment_type_tab";

    protected $fillable = [
        'heavy_equipment_type',
        'heavy_equipment_type_desc',
        'status'
    ];
    protected $sortable = [
        'heavy_equipment_type' => null,
        'heavy_equipment_type_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'heavy_equipment_type' => 0,
        'heavy_equipment_type_desc' => 1,
    ];
    protected $filterable = [
        'heavy_equipment_type',
        'heavy_equipment_type_desc',
    ];
    public function heavy() {
        return $this->hasMany(HeavyEquipment::class, 'm_heavy_equipment_type_id', 'id');
    }
}
