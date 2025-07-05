<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function solicitarTurno(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date', // Validación de la fecha
            'hora' => 'required', // Validación de la hora
            'servicio' => 'required|string', // Validación del servicio
            'usuario_id' => 'required|exists:usuarios,id', // Validación de usuario existente
        ]);

        $turno = Turno::create($request->all());

        return response()->json(['mensaje' => 'Turno creado exitosamente', 'turno' => $turno], 201);
    }
}