<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::getAllServicios();
        $pagina = Pagina::where('nombre_pagina', 'servicios.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('servicios.index', ['servicios' => $servicios, 'pagina' => $pagina]);
    }

    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'servicios.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('servicios.create', ['pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $success = Servicio::createServicio($request->all());

        if ($success) {
            return redirect()->route('servicios.index')->with('success', 'Servicio creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
        }
    }

    public function show($id)
    {
        return view('servicios.show', ['servicio' => Servicio::findOrFail($id)]);
    }

    public function edit($id)
    {
        $pagina = Pagina::where('nombre_pagina', 'servicios.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('servicios.edit', ['servicio' => Servicio::findOrFail($id), 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $success = Servicio::updateServicio($id, $request->all());

        if ($success) {
            return redirect()->route('servicios.edit', ['servicio' => $id])->with('success', 'Servicio actualizado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La actualización falló. Servicio no encontrado.');
        }
    }

    public function destroy($id)
    {
        Servicio::deleteServicio($id);

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $servicios = Servicio::all()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Servicios',
            'tableName' => 'users',
            'headers' => ['ID', 'Nombre', 'Descripcion', 'Precio'],
            'attributes' => ['id', 'nombre', 'descripcion', 'precio'],
            'data' => $servicios,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Servicios.pdf');
    }

}
