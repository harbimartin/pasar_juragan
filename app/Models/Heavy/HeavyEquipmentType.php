<?php

namespace App\Models\Heavy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeavyEquipmentType extends Model
{
    use HasFactory;
    protected $table = "m_heavy_equipment_type_tab";

    protected $fillable = [
        'heavy_equipment_type',
        'heavy_equipment_type_desc',
        'status'
    ];
    public function heavy() {
        return $this->hasMany(HeavyEquipment::class, 'm_heavy_equipment_type_id', 'id');
    }
}
