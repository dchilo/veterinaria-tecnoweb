<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Producto;
use App\Models\Pagina;
use Barryvdh\DomPDF\Facade\Pdf;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::with('producto')->get();
        $pagina = Pagina::where('nombre_pagina', 'promociones.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('promociones.index', compact('promociones', 'pagina'));
    }

    public function create()
    {
        $productos = Producto::all();
        $pagina = Pagina::where('nombre_pagina', 'promociones.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('promociones.create', compact('productos', 'pagina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'descuento' => 'required|numeric|min:0|max:100',
        ]);

        Promocion::create($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción creada exitosamente.');
    }

    public function show($id)
    {
        $promocion = Promocion::with('producto')->findOrFail($id);
        $pagina = Pagina::where('nombre_pagina', 'promociones.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('promociones.show', compact('promocion', 'pagina'));
    }

    public function edit($id)
    {
        $promocion = Promocion::findOrFail($id);
        $productos = Producto::all();
        $pagina = Pagina::where('nombre_pagina', 'promociones.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('promociones.edit', compact('promocion', 'productos', 'pagina'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'descuento' => 'required|numeric|min:0|max:100',
        ]);

        $promocion = Promocion::findOrFail($id);
        $promocion->update($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id);
        $promocion->delete();
        return redirect()->route('promociones.index')->with('success', 'Promoción eliminada exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $promociones = Promocion::with('producto')->get()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Promociones',
            'tableName' => 'promociones',
            'headers' => ['ID', 'Producto', 'Nombre', 'Descripción', 'Descuento'],
            'attributes' => ['id', 'producto.nombre', 'nombre', 'descripcion', 'descuento'],
            'data' => $promociones,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Promociones.pdf');
    }
}
