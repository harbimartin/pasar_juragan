<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model {
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
}
