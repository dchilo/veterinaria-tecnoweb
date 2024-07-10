<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Pagina;
use Barryvdh\DomPDF\Facade\Pdf;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();
        $pagina = Pagina::where('nombre_pagina', 'inventarios.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('inventarios.index', compact('inventarios', 'pagina'));
    }

    public function create()
    {
        $productos = Producto::all();
        $pagina = Pagina::where('nombre_pagina', 'inventarios.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('inventarios.create', compact('productos', 'pagina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'tipo_movimiento' => 'required|string|max:20',
            'fecha_movimiento' => 'required|date',
        ]);
    
        $inventario = Inventario::create($request->all());
    
        // Actualizar el stock del producto
        $producto = Producto::find($request->producto_id);
        if ($request->tipo_movimiento == 'Entrada') {
            $producto->stock += $request->cantidad;
        } elseif ($request->tipo_movimiento == 'Salida') {
            $producto->stock -= $request->cantidad;
        }
        $producto->save();
    
        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }    

    public function show($id)
    {
        $inventario = Inventario::with('producto')->findOrFail($id);
        $pagina = Pagina::where('nombre_pagina', 'inventarios.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('inventarios.show', compact('inventario', 'pagina'));
    }

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = Producto::all();
        $pagina = Pagina::where('nombre_pagina', 'inventarios.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('inventarios.edit', compact('inventario', 'productos', 'pagina'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'tipo_movimiento' => 'required|string|max:20',
            'fecha_movimiento' => 'required|date',
        ]);
    
        $inventario = Inventario::findOrFail($id);
        $producto = Producto::find($request->producto_id);
    
        // Revertir el efecto del movimiento anterior
        if ($inventario->tipo_movimiento == 'Entrada') {
            $producto->stock -= $inventario->cantidad;
        } elseif ($inventario->tipo_movimiento == 'Salida') {
            $producto->stock += $inventario->cantidad;
        }
    
        // Aplicar el efecto del nuevo movimiento
        if ($request->tipo_movimiento == 'Entrada') {
            $producto->stock += $request->cantidad;
        } elseif ($request->tipo_movimiento == 'Salida') {
            $producto->stock -= $request->cantidad;
        }
    
        $producto->save();
        $inventario->update($request->all());
    
        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
    }
    
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $inventarios = Inventario::with('producto')->get()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Inventarios',
            'tableName' => 'inventarios',
            'headers' => ['ID', 'Producto', 'Cantidad', 'Tipo Movimiento', 'Fecha Movimiento'],
            'attributes' => ['id', 'producto.nombre', 'cantidad', 'tipo_movimiento', 'fecha_movimiento'],
            'data' => $inventarios,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Inventarios.pdf');
    }
}
