<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $timestamp = false;
    protected $table = 'm_province_tab';
    protected $fillable = [
        'province_code',
        'province_name',
        'status'];
}
