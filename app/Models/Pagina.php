<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;

    protected $table = 'paginas'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    public $timestamps = false; // Habilitar timestamps (created_at y updated_at)
    protected $fillable = [
        'nombre_pagina',
        'descripcion',
        'contador',
        'link_redireccion',
        'estado',
        'vista_user',
        'vista_tecnico',
    ];
}
