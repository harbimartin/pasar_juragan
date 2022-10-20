<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProvider extends Model {
    use HasFactory;
    protected $table = "t_provider_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_company_id',
        'wh_code',
        'wh_name',
        'wh_npwp',
        'wh_website',
        'wh_logo',
        'm_business_category_id',
        'status'
    ];

    public function company() {
        return $this->hasOne(Company::class, 'id', 'm_company_id');
    }

    public function log() {
        return $this->hasMany(WarehouseProviderLog::class, 't_provider_id', 'id');
    }
}
