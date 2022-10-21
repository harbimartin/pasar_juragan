<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderServiceFile extends Model {
    use HasFactory;
    protected $table = "t_provider_service_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_provider_service_id',
        'file_name',
        'file_url',
        'status',
    ];
}
