<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model {
    use HasFactory;
    protected $table = "t_provider_tab";
    const WAREHOUSE = 1;
    const TRANSPORT = 2;
    const HEAVY_EQUIPMENT = 3;
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

    public function company() {
        return $this->hasOne(Company::class, 'id', 'm_company_id');
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
}
