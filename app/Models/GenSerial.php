<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenSerial extends Model {
    use HasFactory;
    public $table = 'gen_serial_tab';
    public $primaryKey = 'SERIAL_ID';
    public $timestamps = false;
    public $fillable = [
        'YEAR',
        'NEXT_VALUE'
    ];
    public static function generateCode($prefix) {
        $serial = self::find($prefix);
        if ($serial->YEAR != date("Y")) {
            $serial->update([
                'YEAR' => date("Y"),
                'NEXT_VALUE' => 1
            ]);
        }
        $next_value = $serial->NEXT_VALUE;
        $serial->increment('NEXT_VALUE', 1);
        return $serial->PREFIX . $serial->YEAR . str_pad($next_value, $serial->LENGTH, '0', STR_PAD_LEFT);
    }
}
