<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderAddress extends Model {
    use HasFactory;
    protected $table = "t_provider_address_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_id',
        'provider_address_detail',
        'provider_city',
        'provider_province',
        'provider_country',
        'status'
    ];

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 't_provider_id');
    }
}
