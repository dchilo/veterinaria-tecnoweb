<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'proveedor_id',
        'precio',
        'cantidad'
    ];

    // no timestamps
    public $timestamps = false;

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }


    public static function getAllInsumos()
    {
        return Insumo::orderBy('id')->get();

    }

    public static function getInsumoById($insumoId)
    {
        return self::find($insumoId);
    }

    public static function createInsumo(array $data)
    {
        try {
            self::create([
                'nombre' => $data['nombre'],
                'proveedor_id' => $data['proveedor_id'],
                'precio' => $data['precio'],
                'cantidad' => $data['cantidad'],
                // Otros campos según necesidad
            ]);

            return true;
        } catch (\Exception $e) {
            /* dd($e->getMessage()); */
            return false;
        }
    }

    public static function updateInsumo($id, array $data)
    {
        $insumo = self::find($id);

        if ($insumo) {
            $insumo->nombre = $data['nombre'];
            $insumo->proveedor_id = $data['proveedor_id'];
            $insumo->precio = $data['precio'];
            $insumo->cantidad = $data['cantidad'];
            // Actualizar otros campos según sea necesario

            // Guarda los cambios y verifica si la actualización fue exitosa
            $success = $insumo->save();

            return $success; // Devuelve true si la actualización fue exitosa, false de lo contrario
        }

        return false; // Devuelve false si no se encuentra el insumo
    }

    public static function deleteInsumo($insumoId)
    {
        $insumo = self::find($insumoId);

        if ($insumo) {
            $insumo->delete();
        }
    }
}
