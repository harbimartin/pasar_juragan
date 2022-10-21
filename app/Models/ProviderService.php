<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderService extends Model {
    use HasFactory;
    protected $table = "t_provider_service_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_id',
        'service_title',
        'service_desc',
        'service_reference',
        'status',
    ];

    public function type() {
        return $this->hasOne(ContactType::class, 'id', 'm_contact_type_id');
    }
}
