<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = [
        'venta_id',
        'monto',
        'fecha',
        'metodo_pago'
    ];

    public $timestamps = false;

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
}
