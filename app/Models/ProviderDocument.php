<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderDocument extends Model {
    use HasFactory;
    protected $table = "t_provider_doc_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_id',
        'm_doc_id',
        'doc_no',
        'doc_date',
        'doc_expired',
        'doc_attachment',
        'status'
    ];

    public function doc() {
        return $this->hasOne(Document::class, 'id', 'doc_id');
    }

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 't_provider_id');
    }
}
