<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLog extends Model {
    use HasFactory;
    const PROVIDER = 0;
    const ADMIN = 0;
    protected $table = "t_provider_status_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(Provider::class, 'id', 't_provider_id');
    }
}
