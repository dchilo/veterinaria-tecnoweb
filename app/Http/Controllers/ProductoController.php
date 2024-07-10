<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pagina;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $pagina = Pagina::where('nombre_pagina', 'productos.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('productos.index', compact('productos', 'pagina'));
    }

    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'productos.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('productos.create', compact('pagina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_nombre' => 'required|string|max:50',
            'proveedor_contacto' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $pagina = Pagina::where('nombre_pagina', 'productos.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('productos.show', compact('producto', 'pagina'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $pagina = Pagina::where('nombre_pagina', 'productos.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('productos.edit', compact('producto', 'pagina'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proveedor_nombre' => 'required|string|max:50',
            'proveedor_contacto' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $productos = Producto::all()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Productos',
            'tableName' => 'productos',
            'headers' => ['ID', 'Nombre', 'Proveedor', 'Contacto', 'Precio', 'Stock'],
            'attributes' => ['id', 'nombre', 'proveedor_nombre', 'proveedor_contacto', 'precio', 'stock'],
            'data' => $productos,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Productos.pdf');
    }
}
