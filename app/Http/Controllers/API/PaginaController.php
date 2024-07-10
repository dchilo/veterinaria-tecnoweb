<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        if ($user->tipo_usuario == 'Administrador') {
            $paginas = Pagina::all();
        } elseif ($user->tipo_usuario == 'Técnico') {
            $paginas = Pagina::where('vista_tecnico', 1)->get();
        } else {
            $paginas = Pagina::where('vista_user', 1)->get();
        }
        return response()->json($paginas);
    }

    public function show($id)
    {
        // Obtener una página por ID
        $pagina = Pagina::find($id);

        if (!$pagina) {
            return response()->json(['message' => 'Página no encontrada'], 404);
        }

        return response()->json($pagina);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_pagina' => 'required|string',
            'descripcion' => 'string|nullable',
            'contador' => 'integer|nullable',
            'link_redireccion' => 'string|nullable',
            'estado' => 'integer|nullable',
        ]);

        // Crear una nueva página
        $pagina = Pagina::create($request->all());

        return response()->json($pagina, 201);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_pagina' => 'required|string',
            'descripcion' => 'string|nullable',
            'contador' => 'integer|nullable',
            'link_redireccion' => 'string|nullable',
            'estado' => 'integer|nullable',
        ]);

        // Actualizar la página
        $pagina = Pagina::find($id);

        if (!$pagina) {
            return response()->json(['message' => 'Página no encontrada'], 404);
        }

        $pagina->update($request->all());

        return response()->json($pagina, 200);
    }

    public function destroy($id)
    {
        // Eliminar la página por ID
        $pagina = Pagina::find($id);

        if (!$pagina) {
            return response()->json(['message' => 'Página no encontrada'], 404);
        }

        $pagina->delete();

        return response()->json(['message' => 'Página eliminada'], 200);
    }
}
