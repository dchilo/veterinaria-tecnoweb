<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Pagina;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto', 'usuario')->get();
        $pagina = Pagina::where('nombre_pagina', 'ventas.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('ventas.index', ['ventas' => $ventas, 'pagina' => $pagina]);
    }

    public function create()
    {
        $productos = Producto::all();
        $usuarios = User::all();
        $pagina = Pagina::where('nombre_pagina', 'ventas.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('ventas.create', ['productos' => $productos, 'usuarios' => $usuarios, 'pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        Venta::create($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    public function show($id)
    {
        $venta = Venta::with('producto', 'usuario')->findOrFail($id);
        $pagina = Pagina::where('nombre_pagina', 'ventas.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('ventas.show', compact('venta', 'pagina'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $productos = Producto::all();
        $usuarios = User::all();
        $pagina = Pagina::where('nombre_pagina', 'ventas.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('ventas.edit', compact('venta', 'productos', 'usuarios', 'pagina'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);
    
        $venta = Venta::findOrFail($id);
        $venta->update($request->all());
    
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }
    

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
