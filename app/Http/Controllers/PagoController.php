<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Inventario;
use App\Models\Pagina;
use App\Models\Pago;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;

class PagoController extends Controller
{
    public function index()
    {
        if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Técnico') {
            $pagos = Pago::all()->sortBy('id');
        } else {
            $ventas = Venta::where('usuario_id', auth()->user()->id)->orderBy('id', 'desc')->get();
            $pagos = [];
            foreach ($ventas as $venta) {
                $pago = Pago::where('venta_id', $venta->id)->first();
                if ($pago != null) {
                    $pagos[] = $pago;
                }
            }
        }
        $pagina = Pagina::where('nombre_pagina', 'pagos.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('pagos.index', ['pagos' => $pagos, 'pagina' => $pagina]);
    }

    public function show($id)
    {
        $pago = Pago::findOrFail($id);
        $venta = Venta::findOrFail($pago->venta_id);
        $cliente = $venta->cliente;
        $pagina = Pagina::where('nombre_pagina', 'pagos.show')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();

        return view('pagos.show', ['venta' => $venta, 'cliente' => $cliente, 'pagina' => $pagina, 'pago' => $pago]);
    }


    public function qr($id, Request $request)
    {
        $venta = Venta::findOrFail($id);
        $productos = $venta->productos;

        if ($request->metodo_pago == 'QR') {
            $lcPedidoDetalle = [];

            foreach ($productos as $key => $producto) {
                $lcPedidoDetalle[] = [
                    'serial' => $key + 1,
                    'producto' => $producto->nombre,
                    'cantidad' => $producto->pivot->cantidad,
                    'precio' => $producto->precio,
                    'descuento' => 0,
                    'total' => $producto->pivot->cantidad * $producto->precio - 0,
                ];
            }

            $jsonPedidoDetalle = json_encode($lcPedidoDetalle);

            // Llamar a tu función existente para generar el QR
            $qrImage = $this->generarQr('leomogiano@outlook.com', $venta->monto_total, $jsonPedidoDetalle);

            if ($qrImage == null) {
                return redirect()->back()->with('error', 'La creación falló. Intente nuevamente.');
            }

            $pagina = Pagina::where('nombre_pagina', 'pagos.qr')->first();
            $pagina->contador = $pagina->contador + 1;
            $pagina->save();

            foreach ($productos as $producto) {
                $inventario = Inventario::createInventarioPago([
                    'producto_id' => $producto->id,
                    'cantidad' => $producto->pivot->cantidad,
                    'fecha_movimiento' => date('Y-m-d'),
                    'tipo_movimiento' => 'Salida',
                ]);
            }

            $venta->estado = 'Completada';
            $venta->save();

            $pago = Pago::create([
                'venta_id' => $venta->id,
                'monto' => $venta->monto_total,
                'fecha' => date('Y-m-d'),
                'metodo_pago' => $request->metodo_pago,
            ]);

            return view('pagos.qr', ['qrImage' => $qrImage, 'venta' => $venta, 'productos' => $productos, 'pagina' => $pagina]);
        } else {
            $pagina = Pagina::where('nombre_pagina', 'pagos.efectivo')->first();
            $pagina->contador = $pagina->contador + 1;
            $pagina->save();

            foreach ($productos as $producto) {
                $inventario = Inventario::createInventarioPago([
                    'producto_id' => $producto->id,
                    'cantidad' => $producto->pivot->cantidad,
                    'fecha_movimiento' => date('Y-m-d'),
                    'tipo_movimiento' => 'Salida',
                ]);
            }

            $venta->estado = 'Completada';
            $venta->save();

            $pago = Pago::create([
                'venta_id' => $venta->id,
                'monto' => $venta->monto_total,
                'fecha' => date('Y-m-d'),
                'metodo_pago' => $request->metodo_pago,
            ]);

            return view('pagos.efectivo', ['venta' => $venta, 'productos' => $productos, 'pagina' => $pagina]);
        }
    }

    public function generarQr($email, $monto, $pedidos)
    {
        try {
            $qrImage = null;
            $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda = 2;
            $lnTelefono = "62152145";
            $lcNombreUsuario = "LEONARDO MOGIANO";
            $lnCiNit = "6297908";
            $lcNroPago = "test-" . rand(100000, 999999);
            $lnMontoClienteEmpresa = $monto;
            $lcCorreo = $email;
            $lcUrlCallBack = "http://localhost:8000/";
            $lcUrlReturn = "http://localhost:8000/";

            $loClient = new Client();

            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody = [
                "tcCommerceID" => $lcComerceID,
                "tnMoneda" => $lnMoneda,
                "tnTelefono" => $lnTelefono,
                'tcNombreUsuario' => $lcNombreUsuario,
                'tnCiNit' => $lnCiNit,
                'tcNroPago' => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo" => $lcCorreo,
                'tcUrlCallBack' => $lcUrlCallBack,
                "tcUrlReturn" => $lcUrlReturn,
                "taPedidoDetalle" => $pedidos
            ];

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $result = json_decode($loResponse->getBody()->getContents());
            // Verificar si la solicitud fue exitosa y si el campo 'qrImage' está presente
            if ($result->status === 1 && isset($result->values)) {
                // Obtener el valor de 'qrImage' del campo 'values'
                $valuesArray = explode(';', $result->values);
                $base64Image = json_decode($valuesArray[1])->qrImage;
                // Puedes mostrar la imagen directamente en la vista sin guardarla
                $qrImage = $base64Image;
            }

            return $qrImage; // o $qrImage si no necesitas el nombre del archivo
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function generatePDF()
    {
        set_time_limit(500);
        if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Técnico') {
            $pagos = Pago::all()->sortBy('id');
        } else {
            //completadas y orderby id
            $ventas = Venta::where('cliente_id', auth()->user()->id)
                ->where('estado', 'Completada')
                ->orderBy('id', 'desc')
                ->get();
            $pagos = [];
            foreach ($ventas as $venta) {
                $pago = Pago::where('venta_id', $venta->id)->first();
                if ($pago != null) {
                    $pagos[] = $pago;
                }
            }
        }

        $pdfData = [
            'title' => 'Reporte de Pagos',
            'tableName' => 'pagos',
            'headers' => ['ID', 'Venta', 'Monto', 'Fecha', 'Método de Pago'],
            'attributes' => ['id', 'venta_id', 'monto', 'fecha', 'metodo_pago'],
            'data' => $pagos,
        ];

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pdf', compact('pdfData'));

        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('reporte-pagos.pdf');
    }

    public function generateDetallePDF($id)
    {
        set_time_limit(500);
        $pago = Pago::findOrFail($id); //pago detalle de pago
        $venta = Venta::findOrFail($pago->venta_id); // venta respectiva al pago
        $cliente = $venta->cliente; // cliente de la venta
        $producto = $venta->producto; // producto de la venta

        // Carga la vista de la plantilla PDF con los datos
        $pdf = PDF::loadView('utils.pago_pdf', compact('pago', 'venta', 'cliente', 'producto'));
        // Descarga el PDF o devuelve la respuesta según tus necesidades
        return $pdf->download('pago_detalle.pdf');
    }


    public function destroy($id)
    {
        // Buscar el pago por ID
        $pago = Pago::find($id);

        // Verificar si se encontró el pago
        if (!$pago) {
            return redirect()->route('pagos.index')->with('error', 'Pago no encontrado.');
        }

        // Eliminar el pago
        $pago->delete();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado exitosamente.');
    }
}
