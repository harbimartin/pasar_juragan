<?php

namespace App\Models;

use App\Models\Heavy\HeavyEquipment;
use App\Models\Heavy\HeavyEquipmentType;
use App\Models\Transport\Truck;
use App\Models\Transport\TruckType;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Provider extends _List {
    use HasFactory;
    protected $table = "t_provider_tab";
    const WAREHOUSE = 1;
    const TRANSPORT = 2;
    const HEAVY_EQUIPMENT = 3;
    const ITEM = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_company_id',
        'provider_code',
        'provider_name',
        'provider_npwp',
        'provider_website',
        'provider_logo',
        'provider_type_id',
        'm_business_category_id',
        'status'
    ];

    protected $filterable = [
        'province' => null,
        'city' => null,
    ];

    protected $searchable = [
        'provider_name' => 0
    ];

    public function type() {
        return $this->hasOne(ProviderType::class, 'id', 'provider_type_id');
    }

    public function company() {
        return $this->hasOne(Company::class, 'id', 'm_company_id');
    }

    public function category() {
        return $this->hasOne(BusinessCategory::class, 'id', 'm_business_category_id');
    }

    public function log() {
        return $this->hasMany(ProviderLog::class, 't_provider_id', 'id');
    }

    public function address() {
        return $this->hasMany(ProviderAddress::class, 't_provider_id', 'id');
    }

    public function contact() {
        return $this->hasMany(ProviderContact::class, 't_provider_id', 'id');
    }

    public function document() {
        return $this->hasMany(ProviderDocument::class, 't_provider_id', 'id');
    }

    public function service() {
        return $this->hasMany(ProviderService::class, 't_provider_id', 'id');
    }

    public function warehouse() {
        return $this->hasMany(Warehouse::class, 'm_provider_id', 'id');
    }

    public function getCityProvinceAttribute() {
        if (sizeof($this->address) > 0) {
            return $this->address[0]->city->city_name . ', ' . $this->address[0]->province->province_name;
        }
        return '-';
    }

    public function truck() {
        return $this->hasMany(Truck::class, 'm_provider_id', 'id');
    }
    public function heavy() {
        return $this->hasMany(HeavyEquipment::class, 'm_provider_id', 'id');
    }
    public function heavy_type() {
        return $this->hasMany(HeavyEquipmentType::class);
    }

    public static function status_attr() {
        return [
            'name' => 'Status', 'type' => 'SState',
            'color' => [
                'Proposed' => 'blue',
                'Pending' => 'yellow',
                'Approved' => 'green'
            ],
            'align' => 'center'
        ];
    }
    protected function uniqueFilter($query, $key, $value) {
        switch ($key) {
            case 'truck_type':
                $query->whereHas('truck', function ($q) use ($value) {
                    $q->where('m_truck_type_id', $value);
                });
                return $query;
            case 'heavy_type':
                $query->whereHas('heavy', function ($q) use ($value) {
                    $q->where('m_heavy_equipment_type_id', $value);
                });
                return $query;
        }
    }

    protected function uniqueOption($query, $key, $value) {
        switch ($key) {
            case 'province':
                $query->whereHas('address', function ($q) use ($value) {
                    $q->where('provider_province', $value);
                });
                break;
            case 'city':
                $query->whereHas('address', function ($q) use ($value) {
                    $q->where('provider_city', $value);
                });
                break;
        }
        return $query;
    }
}
