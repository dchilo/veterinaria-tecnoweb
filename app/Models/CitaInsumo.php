<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaInsumo extends Pivot
{
    protected $table = 'citas_insumos';
    protected $fillable = ['cita_id', 'insumo_id', 'cantidad'];

    public $timestamps = false;
}
