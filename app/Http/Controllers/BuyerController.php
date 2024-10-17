<?php

namespace App\Http\Controllers;

use App\Models\Product; // Asegúrate de importar el modelo de Producto
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        // Obtén todos los productos publicados por los vendedores
        $products = Product::all(); // Puedes modificar esto para obtener productos de vendedores específicos si es necesario
        return view('comprador.index', compact('products'));
    }
}
