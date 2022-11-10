<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends _List {
    use HasFactory;
    protected $table = "m_contact_type_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contact_type',
        'status'
    ];
    protected $sortable = [
        'contact_type' => null,
        'status' => null
    ];
    protected $searchable = [
        'contact_type' => 0,
    ];
    protected $filterable = [
        'contact_type',
    ];
}
