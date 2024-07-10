<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        // Otros campos según necesidad
    ];

    // no timestamps
    public $timestamps = false;

    public static function getAllServicios()
    {
        return Servicio::orderBy('id')->get();
    }

    public static function getServicioById($servicioId)
    {
        return self::find($servicioId);
    }

    public static function createServicio(array $data)
    {
        try {
            self::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                // Otros campos según necesidad
            ]);

            return true;
        } catch (\Exception $e) {
            /* dd($e->getMessage()); */
            return false;
        }
    }

    public static function updateServicio($id, array $data)
    {
        $servicio = self::find($id);

        if ($servicio) {
            $servicio->nombre = $data['nombre'];
            $servicio->descripcion = $data['descripcion'];
            $servicio->precio = $data['precio'];
            // Actualizar otros campos según sea necesario

            // Guarda los cambios y verifica si la actualización fue exitosa
            $success = $servicio->save();

            return $success; // Devuelve true si la actualización fue exitosa, false de lo contrario
        }

        return false; // Devuelve false si no se encuentra el servicio
    }

    public static function deleteServicio($servicioId)
    {
        $servicio = self::find($servicioId);

        if ($servicio) {
            $servicio->delete();
        }
    }
}
