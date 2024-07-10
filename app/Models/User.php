<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'tipo_usuario',
    ];

    

    // Métodos CRUD personalizados

    public static function getAllUsers()
    {
        return self::orderBy('id')->get();
    }

    public static function getUserById($userId)
    {
        return self::find($userId);
    }

    public static function createUser(array $data)
    {
        try {
            self::create([
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'phone' => $data['phone'],
                'tipo_usuario' => $data['tipo_usuario'],
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return false;
        }
    }


    /* public static function updateUser($id, array $data)
    {
        $user = self::find($id);

        if ($user) {
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->tipo_usuario = $data['tipo_usuario'];

            // Guarda los cambios y verifica si la actualización fue exitosa
            $success = $user->save();

            return $success; // Devuelve true si la actualización fue exitosa, false de lo contrario
        }

        return false; // Devuelve false si no se encuentra el usuario
    } */

    public static function deleteUser($userId)
    {
        $user = self::find($userId);

        if ($user) {
            $user->delete();
        }
    }
}
