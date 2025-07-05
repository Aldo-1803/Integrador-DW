<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ProductoController extends Controller
{
    public function catalogo()
    {
        $productos = Producto::all(); // Obtiene todos los productos del catálogo
        return response()->json($productos); // Retorna los productos en formato JSON
    }
}