<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{

    public function index()
    {
        return view('reserva');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email',
            'clase' => 'required|string',
            'fecha' => 'required|date',
        ]);

        Reserva::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'clase' => $request->clase,
            'fecha' => $request->fecha,
        ]);

        return back()->with('success', '✅ Reserva registrada correctamente.');
    }
}


