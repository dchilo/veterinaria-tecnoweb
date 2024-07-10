<?php

namespace App\Http\Controllers;

use App\Models\Motorizado;
use App\Models\Pagina;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MotorizadoController extends Controller
{
    public function index()
    {
        if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Técnico') {
            $motorizados = Motorizado::all();
        } else {
            $motorizados = Motorizado::getAllMotorizadosByUser(auth()->user()->id);
        }
        $pagina = Pagina::where('nombre_pagina', 'motorizados.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        $usuarios = User::all();

        return view('motorizados.index', ['motorizados' => $motorizados, 'usuarios' => $usuarios, 'pagina' => $pagina]);
    }

    public function create()
    {
        $usuarios = User::where('tipo_usuario', 'Cliente')->get();
        $pagina = Pagina::where('nombre_pagina', 'motorizados.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('motorizados.create', ['usuarios' => $usuarios, 'pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $success = Motorizado::createMotorizado($request->all());

        if ($success) {
            return redirect()->route('motorizados.index')->with('success', 'Motorizado creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
        }
    }

    public function show($id)
    {
        return view('motorizados.show', ['motorizado' => Motorizado::findOrFail($id)]);
    }

    public function edit($id)
    {
        $motorizado = Motorizado::findOrFail($id);
        $usuarios = User::all(); // Asegúrate de tener la función en el modelo Usuario
        $pagina = Pagina::where('nombre_pagina', 'motorizados.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('motorizados.edit', ['motorizado' => $motorizado, 'usuarios' => $usuarios, 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $success = Motorizado::updateMotorizado($id, $request->all());

        if ($success) {
            return redirect()->route('motorizados.edit', ['motorizado' => $id])->with('success', 'Motorizado actualizado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La actualización falló. Motorizado no encontrado.');
        }
    }

    public function destroy($id)
    {
        Motorizado::deleteMotorizado($id);

        return redirect()->route('motorizados.index')->with('success', 'Motorizado eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Técnico') {
            $motorizados = Motorizado::with('cliente')->orderBy('id')->get();
        } else {
            $motorizados = Motorizado::with('cliente')->where('cliente_id', auth()->user()->id)->orderBy('id')->get();
        }

        $pdfData = [
            'title' => 'Reporte de Motorizados',
            'tableName' => 'motorizados',
            'headers' => ['ID', 'Cliente', 'Modelo', 'Marca', 'Año', 'Placa', 'Estado'],
            'attributes' => ['id', 'cliente', 'modelo', 'marca', 'anio', 'placa', 'estado'],
            'data' => $motorizados,
        ];

        // dd($pdfData);
        // return;

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Motorizados.pdf');
    }
}
