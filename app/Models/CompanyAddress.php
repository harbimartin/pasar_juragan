<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model {
    use HasFactory;
    protected $table = "m_company_address_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_company_id',
        'comp_address_detail',
        'comp_city',
        'comp_province',
        'comp_country',
        'status'
    ];
}
