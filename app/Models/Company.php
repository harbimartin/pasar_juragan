<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    use HasFactory;
    protected $table = "m_company_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comp_code',
        'comp_name',
        'comp_npwp',
        'm_business_category_id',
        'status'
    ];

    public function category() {
        return $this->hasOne(BusinessCategory::class, 'id', 'm_business_category_id');
    }

    public function address() {
        return $this->hasMany(CompanyAddress::class, 'm_company_id', 'id');
    }

    public function user() {
        return $this->hasMany(User::class, 'm_company_id', 'id');
    }
}
