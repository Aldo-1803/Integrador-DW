<?php

namespace App\Http\Controllers; // Controlador de autenticación

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registrar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255', // Validación del nombre
            'apellido' => 'required|string|max:255', // Validación del apellido
            'correo_electronico' => 'required|email|max:255|unique:usuarios,correo_electronico', // Validación del correo electrónico
            'contraseña' => 'required|string|min:8', // Validación de la contraseña
            'telefono' => 'nullable|string|max:20', // Validación del teléfono
            'red_social' => 'nullable|string|max:255', // Validación de la red social
            'fecha_nacimiento' => 'nullable|date', // Validación de la fecha de nacimiento
        ]);

        if ($validator->fails()) {
            return response()->json(['errpres' => $validator->errors()], 400);
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre, // Asignación del nombre
            'apellido' => $request->apellido, // Asignación del apellido
            'correo_electronico' => $request->correo_electronico, // Asignación del correo electrónico
            'contraseña' => Hash::make($request->contraseña), // Hash de la contraseña
            'telefono' => $request->telefono, // Asignación del teléfono
            'red_social' => $request->red_social, // Asignación de la red social
            'fecha_nacimiento' => $request->fecha_nacimiento, // Asignación de la fecha de nacimiento
        ]);

        return response()->json(['mensaje' => 'Usuario registrado exitosamente', 'usuario' => $usuario]);
    }

    public function iniciarSesion(Request $request)
    {
        $credentials = $request->only('correo_electronico', 'contraseña');

        //Buscar ususario por correo electronico
        $usuario = Usuario::where('correo_electronico', $credentials['correo_electronico'])->first();
        
        //verificar usuario y contraseña
        if (!$usuario || !Hash::check($credentials['contraseña'], $usuario->contraseña)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Si las credenciales son válidas, retornar un mensaje de éxito
        // Aquí podrías generar un token JWT o una sesión si lo necesitas
        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'usuario' => [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido
            ]
        ]);
    
    }
}
