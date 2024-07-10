<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::getAllProveedores();
        $pagina = Pagina::where('nombre_pagina', 'proveedores.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('proveedores.index', ['proveedores' => $proveedores, 'pagina' => $pagina]);
    }

    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'proveedores.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('proveedores.create', ['pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $success = Proveedor::createProveedor($request->all());

        if ($success) {
            return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
        }
    }

    public function show($id)
    {
        return view('proveedores.show', ['proveedor' => Proveedor::findOrFail($id)]);
    }

    public function edit($id)
    {
        $pagina = Pagina::where('nombre_pagina', 'proveedores.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('proveedores.edit', ['proveedor' => Proveedor::findOrFail($id), 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $success = Proveedor::updateProveedor($id, $request->all());

        if ($success) {
            return redirect()->route('proveedores.edit', ['proveedore' => $id])->with('success', 'Proveedor actualizado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La actualización falló. Proveedor no encontrado.');
        }
    }

    public function destroy($id)
    {
        Proveedor::deleteProveedor($id);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }

    public function generatePDF()
    {
        set_time_limit(500);
        $proveedores = Proveedor::all()->sortBy('id');

        $pdfData = [
            'title' => 'Reporte de Proveedores',
            'tableName' => 'users',
            'headers' => ['ID', 'Nombre', 'Email', 'Telefono',   'Dirección'],
            'attributes' => ['id', 'nombre', 'email', 'telefono', 'direccion'],
            'data' => $proveedores,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Proveedor.pdf');
    }
}
