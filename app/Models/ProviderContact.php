<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderContact extends Model {
    use HasFactory;
    protected $table = "t_provider_contact_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_id',
        'm_contact_type_id',
        'provider_contact_name',
        'provider_contact_position',
        'provider_contact',
        'status'
    ];

    public function type() {
        return $this->hasOne(ContactType::class, 'id', 'm_contact_type_id');
    }

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 't_provider_id');
    }
}
