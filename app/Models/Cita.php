<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'cliente_id',
        'motorizado_id',
        'fecha_hora',
        'estado',
        'monto_total',
        // Otros campos según sea necesario
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function motorizado()
    {
        return $this->belongsTo(Motorizado::class, 'motorizado_id');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'citas_servicios')
            ->using(CitaServicio::class)
            ->withPivot('cantidad'); // Para obtener la cantidad en la relación
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'citas_insumos')
            ->using(CitaInsumo::class)
            ->withPivot('cantidad'); // Para obtener la cantidad en la relación
    }

    public static function addInsumo($citaId, $insumoId, $cantidad)
    {
        $cita = self::find($citaId);
        $insumo = Insumo::find($insumoId);

        if ($cita && $insumo) {
            $precioTotal = $insumo->precio * $cantidad;
            $cita->insumos()->attach($insumoId, ['cantidad' => $cantidad]);

            // Descuenta la cantidad solo en insumo
            $insumo->update(['cantidad' => $insumo->cantidad - $cantidad]);

            $cita->update(['monto_total' => $cita->monto_total + $precioTotal]);
        }
    }

    public static function deleteInsumo($citaId, $insumoId)
    {
        $cita = self::find($citaId);
        $insumo = Insumo::find($insumoId);

        if ($cita && $insumo) {
            $cantidad = $cita->insumos()->where('insumo_id', $insumoId)->first()->pivot->cantidad;
            $precioTotal = $insumo->precio * $cantidad;

            $cita->insumos()->detach($insumoId);

            // Ajusta la cantidad solo en insumo
            $insumo->update(['cantidad' => $insumo->cantidad + $cantidad]);

            $cita->update(['monto_total' => $cita->monto_total - $precioTotal]);
        }
    }

    public static function addServicio($citaId, $servicioId, $cantidad)
    {
        $cita = self::find($citaId);
        $servicio = Servicio::find($servicioId);

        if ($cita && $servicio) {
            $precioTotal = $servicio->precio * $cantidad;
            $cita->servicios()->attach($servicioId, ['cantidad' => $cantidad]);
            $cita->update(['monto_total' => $cita->monto_total + $precioTotal]);
        }
    }

    public static function deleteServicio($citaId, $servicioId)
    {
        $cita = self::find($citaId);
        $servicio = Servicio::find($servicioId);

        if ($cita && $servicio) {
            $cantidad = $cita->servicios()->where('servicio_id', $servicioId)->first()->pivot->cantidad;
            $precioTotal = $servicio->precio * $cantidad;

            $cita->servicios()->detach($servicioId);
            $cita->update(['monto_total' => $cita->monto_total - $precioTotal]);
        }
    }


    /**
     * Obtiene todos los insumos de una cita por su ID.
     *
     * @param int $citaId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getInsumos($citaId)
    {
        $cita = self::find($citaId);
        return $cita->insumos;
    }

    /**
     * Obtiene todos los servicios de una cita por su ID.
     *
     * @param int $citaId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getServicios($citaId)
    {
        $cita = self::find($citaId);
        return $cita->servicios;
    }

    /**
     * Crea una nueva cita con la información proporcionada.
     *
     * @param array $data
     * @return Cita
     */
    public static function crearCita(array $data)
    {
        return self::create($data);
    }

    /**
     * Actualiza la información de una cita existente.
     *
     * @param int $citaId
     * @param array $data
     * @return bool
     */
    public static function actualizarCita($citaId, array $data)
    {
        $cita = self::find($citaId);

        if ($cita) {
            return $cita->update($data);
        }

        return false;
    }

    /**
     * Elimina una cita por su ID.
     *
     * @param int $citaId
     * @return bool
     */
    public static function eliminarCita($citaId)
    {
        $cita = self::find($citaId);

        if ($cita) {
            return $cita->delete();
        }

        return false;
    }
}
