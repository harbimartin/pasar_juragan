<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends _List {
    use HasFactory;
    protected $table = "m_business_category_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_category',
        'status'
    ];
    protected $sortable = [
        'business_category' => null,
        'status' => null
    ];
    protected $searchable = [
        'business_category' => 0,
    ];
    protected $filterable = [
        'business_category',
    ];

    public function company() {
        return $this->hasMany(Company::class, 'm_business_category_id', 'id');
    }
}
