<?php

namespace App\Models;

use App\Models\Heavy\HeavyEquipment;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\Transport;

class Image extends Model {
    use HasFactory;
    protected $table = "t_image_tab";
    const WAREHOUSE = 1;
    const TRANSPORT = 2;
    const HEAVY_EQUIPMENT = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_type',
        'm_code_id',
        'image_url',
        'image_desc',
    ];

    public function product() {
        switch ($this->image_type) {
            case self::WAREHOUSE:
                return $this->hasOne(Warehouse::class, 'id', 'm_code_id');
            case self::TRANSPORT:
                return $this->hasOne(Transport::class, 'id', 'm_code_id');
            case self::HEAVY_EQUIPMENT:
                return $this->hasOne(HeavyEquipment::class, 'id', 'm_code_id');
        }
    }

    public function type() {
        return $this->hasOne(ProviderType::class, 'id', 'image_type');
    }
}
