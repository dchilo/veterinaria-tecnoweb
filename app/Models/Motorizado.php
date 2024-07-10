<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'anio',
        'placa',
        'estado'
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public static function getAllMotorizados()
    {
        return self::orderBy('id')->get();
    }

    public static function getMotorizadoById($motorizadoId)
    {
        return self::find($motorizadoId);
    }

    public static function getAllMotorizadosByUser($userId)
    {
        return self::where('cliente_id', $userId)->orderBy('id')->paginate(10);
    }

    public static function createMotorizado(array $data)
    {
        try {
            self::create([
                'cliente_id' => $data['cliente_id'],
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'anio' => $data['anio'],
                'placa' => $data['placa'],
                'estado' => $data['estado'],
                // Otros campos según necesidad
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateMotorizado($id, array $data)
    {
        $motorizado = self::find($id);

        if ($motorizado) {
            $motorizado->cliente_id = $data['cliente_id'];
            $motorizado->marca = $data['marca'];
            $motorizado->modelo = $data['modelo'];
            $motorizado->anio = $data['anio'];
            $motorizado->placa = $data['placa'];
            $motorizado->estado = $data['estado'];
            // Actualizar otros campos según sea necesario

            $success = $motorizado->save();

            return $success;
        }

        return false;
    }

    public static function deleteMotorizado($motorizadoId)
    {
        $motorizado = self::find($motorizadoId);

        if ($motorizado) {
            $motorizado->delete();
        }
    }
}
