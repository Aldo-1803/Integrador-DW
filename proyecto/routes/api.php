<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AuthController::class, 'registrar']);
Route::post('/login', [AuthController::class, 'iniciarSesion']);
Route::post('/turno', [TurnoController::class, 'solicitarTurno']);
Route::get('/servicios', [ServicioController::class, 'index']);
Route::get('/turnos/{usuario_id}', [TurnoController::class, 'misTurnos']);
Route::get('/productos', [ProductoController::class, 'catalogo']);


