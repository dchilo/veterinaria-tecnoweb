<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAllUsers();
        $pagina = Pagina::where('nombre_pagina', 'usuarios.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('usuarios.index', ['users' => $users, 'pagina' => $pagina]);
    }

    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'usuarios.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('usuarios.create', ['pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'tipo_usuario' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'tipo_usuario' => $request->input('tipo_usuario'),
        ]);

        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);
    }

    public function show($id)
    {
        return view('usuarios.show', ['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        $pagina = Pagina::where('nombre_pagina', 'usuarios.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('usuarios.edit', ['user' => User::findOrFail($id), 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:255',
            'tipo_usuario' => 'required|string|in:Técnico,Cliente,Administrador',
            'password' => 'nullable|string|min:8', // La contraseña es opcional
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->tipo_usuario = $request->tipo_usuario;

            // Actualizar la contraseña solo si se proporciona una nueva contraseña
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->route('usuarios.update', $id)->with('success', 'Usuario actualizado exitosamente.');
        } catch (QueryException $e) {
            // Captura el error de correo duplicado
            if ($e->getCode() == 23000) {
                return redirect()->back()->withErrors(['email' => 'El correo electrónico ya está en uso.']);
            }

            // Si el error es otro, simplemente lo relanzamos
            throw $e;
        }
    }

    public function destroy($id)
    {
        User::deleteUser($id);

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $users = User::all()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Usuarios',
            'tableName' => 'users',
            'headers' => ['ID', 'Nombre', 'Email', 'Rol',   'Creación'],
            'attributes' => ['id', 'name', 'email', 'tipo_usuario', 'created_at'],
            'data' => $users,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Usuario.pdf');
    }
}
