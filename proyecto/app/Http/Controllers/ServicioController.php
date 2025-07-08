<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        return response()->json(Servicio::all());
    }
}
