<?php
namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // Incrementar el contador de visitas
        $pagina = Pagina::where('nombre_pagina', 'dashboard')->first();
        $pagina->increment('contador');

        // Consultar datos necesarios
        $usuarios = User::count();
        $servicios = Servicio::take(5)->get();
        $productos = Producto::take(5)->get();

        return view('dashboard', compact('pagina', 'usuarios', 'servicios', 'productos'));
    }
}
