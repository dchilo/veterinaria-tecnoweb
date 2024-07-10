<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones'; // Especifica el nombre de la tabla

    protected $fillable = [
        'producto_id',
        'nombre',
        'descripcion',
        'descuento',
    ];

    public $timestamps = false; // Deshabilitar los timestamps automáticos de Laravel

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
