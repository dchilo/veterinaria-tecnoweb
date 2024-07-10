<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_nombre',
        'proveedor_contacto',
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];

    public $timestamps = false; // Deshabilitar las marcas de tiempo automáticas

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'producto_id');
    }
}
