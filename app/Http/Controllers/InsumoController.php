<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Pagina;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::getAllInsumos();
        $proveedores = Proveedor::all(); 
        $pagina = Pagina::where('nombre_pagina', 'insumos.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('insumos.index', ['insumos' => $insumos, 'proveedores' => $proveedores, 'pagina' => $pagina]);
    }

    public function create()
    {
        $proveedores = Proveedor::all(); 
        $pagina = Pagina::where('nombre_pagina', 'insumos.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('insumos.create', ['proveedores' => $proveedores, 'pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $success = Insumo::createInsumo($request->all());

        if ($success) {
            return redirect()->route('insumos.index')->with('success', 'Insumo creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
        }
    }

    public function show($id)
    {
        return view('insumos.show', ['insumo' => Insumo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);
        $proveedores = Proveedor::all(); // Asegúrate de tener la función en el modelo Proveedor
        $pagina = Pagina::where('nombre_pagina', 'insumos.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('insumos.edit', ['insumo' => $insumo, 'proveedores' => $proveedores, 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $success = Insumo::updateInsumo($id, $request->all());

        if ($success) {
            return redirect()->route('insumos.edit', ['insumo' => $id])->with('success', 'Insumo actualizado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La actualización falló. Insumo no encontrado.');
        }
    }

    public function destroy($id)
    {
        Insumo::deleteInsumo($id);

        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $insumos = Insumo::with('proveedor')->orderBy('id')->get();

        $pdfData = [
            'title' => 'Reporte de Insumos',
            'tableName' => 'insumos',
            'headers' => ['ID', 'Nombre', 'Proveedor', 'Precio',   'Cantidad'],
            'attributes' => ['id', 'nombre', 'proveedor', 'precio', 'cantidad'],
            'data' => $insumos,
        ];

        

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Inventario.pdf');
    }
}
