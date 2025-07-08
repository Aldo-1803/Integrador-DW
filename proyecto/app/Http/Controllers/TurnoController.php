<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function solicitarTurno(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id', // Validación del servicio
            'usuario_id' => 'required|exists:usuarios,id', // Validación de usuario existente
            'fecha' => 'required|date', // Validación de la fecha
            'hora' => 'required' // Validación de la hora
        ]);

        $turno = Turno::create([
            'usuario_id' => $request->usuario_id,
            'servicio_id' => $request->servicio_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente'
        ]);

        return response()->json(['mensaje' => 'Turno creado exitosamente', 'turno' => $turno], 201);
    }

    public function misTurnos($usuario_id)
    {
        $turnos = Turno::with('servicio')
            ->where('usuario_id', $usuario_id)
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        return response()->json($turnos);
    }

    public function mostrarTurnosPendientes($usuarioId)
    {
        $turnos = Turno::with('servicio')
            ->where('usuario_id', $usuarioId)
            ->where('estado', 'pendiente')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get()
            ->map(function ($turno) {
                return [
                    'fecha' => $turno->fecha,
                    'hora' => $turno->hora,
                    'servicio' => $turno->servicio->nombre
                ];
            });
        
            //
        return response()->json($turnos);
    }
}