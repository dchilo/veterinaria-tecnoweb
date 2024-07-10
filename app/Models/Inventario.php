<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'tipo_movimiento',
        'fecha_movimiento',
    ];

    public $timestamps = false; // Deshabilitar los timestamps automáticos de Laravel

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
