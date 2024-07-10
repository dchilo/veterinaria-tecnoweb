<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    public function index()
    {
        $pagina = Pagina::where('nombre_pagina', 'perfil.index')->first();
        $pagina->contador = $pagina->contador + 1;
        $pagina->save();
        return view('perfil.index', compact('pagina'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['max:50'],
            'password' => ['nullable', 'min:8', 'confirmed'], // Add password validation
        ]);

        $user = Auth::user();

        // Check if the email is being updated
        if ($request->filled('email') && $request->email != $user->email) {
            $attributes['email'] = $request->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
            ])['email'];
        }

        // Build the update array
        $updateArray = [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $updateArray['password'] = bcrypt($attributes['password']);
        }

        // Update user details using query builder
        User::where('id', Auth::user()->id)->update($updateArray);

        return redirect()->route('perfil.index')->with('success', 'El perfil se ha actualizado correctamente');
    }
}
