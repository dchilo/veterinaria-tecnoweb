<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'login')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('session.login-session', compact('pagina'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            $pagina = Pagina::where('nombre_pagina', 'dashboard')->first();
            $pagina->contador = $pagina->contador + 1;
            $pagina->save();

            $citas_completadas = Cita::where('estado', 'Completada')->count();
            $citas_pendientes = Cita::where('estado', 'Pendiente')->count();
            $citas_proceso = Cita::where('estado', 'En Proceso')->count();
            $usuarios = User::count();

            return redirect('dashboard')->with(['success' => 'Te has logueado correctamente', 'pagina' => $pagina, 'citas_completadas' => $citas_completadas, 'citas_pendientes' => $citas_pendientes, 'citas_proceso' => $citas_proceso, 'usuarios' => $usuarios]);
        } else {

            return back()->withErrors(['email' => 'Email o contraseña incorrectos.']);
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'Te has deslogueado correctamente']);
    }
}
