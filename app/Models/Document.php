<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends _List {
    use HasFactory;
    protected $table = "m_doc_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'doc_name',
        'doc_desc',
        'm_provider_type_id',
        'status'
    ];
    protected $sortable = [
        'destination_name' => null,
        'destination_desc' => null,
        'status' => null
    ];
    protected $searchable = [
        'destination_name' => 0,
        'destination_desc' => 1,
    ];
    protected $filterable = [
        'destination_name',
        'destination_desc',
    ];

    public function provider() {
        return $this->hasMany(ProviderDocument::class, 'm_doc_id', 'id');
    }
    public function provider_type() {
        return $this->hasOne(ProviderType::class, 'id', 'm_provider_type_id');
    }
}
