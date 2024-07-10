<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Proveedor extends Authenticatable
{
    use HasFactory, Notifiable;

    //table
    protected $table = 'proveedores';



    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];
    //no timestamp
    public $timestamps = false;

    // Métodos CRUD personalizados

    public static function getAllProveedores()
    {
        $proveedores = Proveedor::orderBy('id')->get();
        return $proveedores;
    }

    public static function getProveedorById($proveedorId)
    {
        return self::find($proveedorId);
    }

    public static function createProveedor(array $data)
    {
        try {
            self::create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return false;
        }
    }

    public static function updateProveedor($id, array $data)
    {
        $proveedor = self::find($id);

        if ($proveedor) {
            $proveedor->nombre = $data['nombre'];
            $proveedor->email = $data['email'];
            $proveedor->telefono = $data['telefono'];
            $proveedor->direccion = $data['direccion'];

            // Guarda los cambios y verifica si la actualización fue exitosa
            $success = $proveedor->save();

            return $success; // Devuelve true si la actualización fue exitosa, false de lo contrario
        }

        return false; // Devuelve false si no se encuentra el proveedor
    }

    public static function deleteProveedor($proveedorId)
    {
        $proveedor = self::find($proveedorId);

        if ($proveedor) {
            $proveedor->delete();
        }
    }
}
