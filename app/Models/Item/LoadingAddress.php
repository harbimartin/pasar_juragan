<?php

namespace App\Models\Item;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadingAddress extends Model {
    use HasFactory;
    protected $table = "m_loading_address_tab";

    protected $fillable = [
        'm_company_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'status'
    ];

    public function company() {
        return $this->hasOne(Company::class, 'id', 'm_company_id');
    }
}
