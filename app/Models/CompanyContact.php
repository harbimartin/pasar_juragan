<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model {
    use HasFactory;
    protected $table = "m_company_contact_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_company_id',
        'm_contact_type_id',
        'comp_contact_name',
        'comp_contact_position',
        'comp_contact',
        'status'
    ];

    public function type() {
        return $this->hasOne(ContactType::class, 'id', 'm_contact_type_id');
    }
}
