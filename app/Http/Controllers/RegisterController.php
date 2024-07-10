<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $pagina = Pagina::where('nombre_pagina', 'register')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('session.register', compact('pagina'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);

        $attributes['tipo_usuario'] = 'Cliente';

        $attributes['password'] = bcrypt($attributes['password']);

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);

        $pagina = Pagina::where('nombre_pagina', 'dashboard')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        
        return redirect('/dashboard')->with(['success' => 'Te has registrado correctamente', 'pagina' => $pagina]);
    }
}
