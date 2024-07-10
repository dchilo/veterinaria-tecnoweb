<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Insumo;
use App\Models\Motorizado;
use App\Models\Pagina;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        if( auth()->user()->tipo_usuario == 'Cliente' ){
            $citas = Cita::where('cliente_id', auth()->user()->id)->get();
        }else{
            $citas = Cita::all();
        }
        $servicios = Servicio::all();
        $insumos = Insumo::all();

        $pagina = Pagina::where('nombre_pagina', 'citas.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('citas.index', ['citas' => $citas, 'servicios' => $servicios, 'insumos' => $insumos, 'pagina' => $pagina]);
    }

    public function create()
    {
        $clientes = User::where('tipo_usuario', 'Cliente')->get();
        $motorizados = Motorizado::all();
        $pagina = Pagina::where('nombre_pagina', 'citas.create')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('citas.create', ['clientes' => $clientes, 'motorizados' => $motorizados, 'pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $success = Cita::crearCita($request->all());

        if ($success) {
            return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
        }
    }


    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'En Proceso';
        $cita->save();
        $servicios = Servicio::all();
        $insumos = Insumo::all();
        $clientes = User::where('tipo_usuario', 'Cliente')->get();
        $motorizados = Motorizado::all();

        $pagina = Pagina::where('nombre_pagina', 'citas.edit')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('citas.edit', ['cita' => $cita, 'servicios' => $servicios, 'insumos' => $insumos, 'clientes' => $clientes, 'motorizados' => $motorizados, 'pagina' => $pagina]);
    }

    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        $servicios = Servicio::all();
        $insumos = Insumo::all();
        $clientes = User::where('tipo_usuario', 'Cliente')->get();
        $motorizados = Motorizado::all();

        $pagina = Pagina::where('nombre_pagina', 'citas.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('citas.show', ['cita' => $cita, 'servicios' => $servicios, 'insumos' => $insumos, 'clientes' => $clientes, 'motorizados' => $motorizados, 'pagina' => $pagina]);
    }

    public function update($id, Request $request)
    {
        $cita = Cita::findOrFail($id);

        // Obtener los insumos actuales antes de la actualización
        $insumosAnteriores = $cita->insumos;   

        foreach ($insumosAnteriores as $insumoAnterior) {
            $insumo = Insumo::findOrFail($insumoAnterior->id);
            $insumo->cantidad = $insumo->cantidad + $insumoAnterior->pivot->cantidad;
            $insumo->save();

        }
        
        // Eliminar servicios e insumos existentes
        $cita->servicios()->detach();
        $cita->insumos()->detach();

        // Decodificar datos JSON
        $serviciosData = json_decode($request->serviciosData, true);
        $insumosData = json_decode($request->insumosData, true);

        // Actualizar datos de la cita
        $cita->monto_total = $request->montoTotal;
        $cita->cliente_id = $request->cliente_id;
        $cita->motorizado_id = $request->motorizado_id;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->save();

        // Agregar nuevos servicios
        foreach ($serviciosData as $servicio) {
            $cita->servicios()->attach($servicio['id'], ['cantidad' => 1]);
            // actualizar cantidad de servicio
        }

        // Agregar nuevos insumos
        foreach ($insumosData as $insumo) {
            $cita->insumos()->attach($insumo['id'], ['cantidad' => $insumo['cantidad']]);
            // actualizar cantidad de insumo
            $insumoModel = Insumo::findOrfail($insumo['id']);
            $insumoModel->cantidad = $insumoModel->cantidad - $insumo['cantidad'];
            $insumoModel->save();
        }


        if ($cita) {
            return redirect()->route('citas.edit', ['cita' => $id])->with('success', 'Cita actualizada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La actualización falló. Cita no encontrada.');
        }
    }



    public function destroy($id)
    {
        Cita::eliminarCita($id);

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }

    public function addInsumo(Request $request, $citaId)
    {
        Cita::addInsumo($citaId, $request->insumo_id, $request->cantidad_insumo);
        return redirect()->back()->with('success', 'Insumo agregado correctamente');
    }

    public function addServicio(Request $request, $citaId)
    {
        Cita::addServicio($citaId, $request->servicio_id, $request->cantidad_servicio);
        return redirect()->back()->with('success', 'Servicio agregado correctamente');
    }

    public function deleteInsumo(Request $request, $citaId, $insumoId)
    {
        Cita::deleteInsumo($citaId, $insumoId);
        return redirect()->back()->with('success', 'Insumo eliminado correctamente');
    }

    public function deleteServicio(Request $request, $citaId, $servicioId)
    {
        Cita::deleteServicio($citaId, $servicioId);
        return redirect()->back()->with('success', 'Servicio eliminado correctamente');
    }

    public function generatePDF()
    {
        if( auth()->user()->tipo_usuario == 'Cliente' ){
            $citas = Cita::where('cliente_id', auth()->user()->id)->get();
        }else{
        $citas = Cita::with(['cliente', 'motorizado'])->orderby('id', 'asc')->get();
        }
        $pdfData = [
            'title' => 'Reporte de Citas',
            'tableName' => 'users',
            'headers' => ['ID', 'Cliente', 'Motorizado', 'Fecha y Hora', 'Estado'],
            'attributes' => ['id', 'cliente', 'motorizado', 'fecha_hora', 'estado'],
            'data' => $citas,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('Reporte_Citas.pdf');
    }
}
