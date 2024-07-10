<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaServicio extends Pivot
{
    protected $table = 'citas_servicios';
    protected $fillable = ['cita_id', 'servicio_id', 'cantidad'];
    
    public $timestamps = false;
}
