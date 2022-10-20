<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProviderLog extends Model {
    use HasFactory;
    protected $table = "t_warehouse_provider_status_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_warehouse_provider_id',
        'user_type',
        'user_id',
        'status',
        'status_note'
    ];

    public function parent() {
        return $this->hasOne(WarehouseProvider::class, 'id', 't_warehouse_provider_id');
    }
}
