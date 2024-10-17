<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // Lógica para agregar el producto al carrito
        // Por ejemplo, podrías usar la sesión para almacenar el carrito
        $cart = session()->get('cart', []);
        
        // Agregar producto al carrito
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
        ];

        session()->put('cart', $cart);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    public function index()
{
    // Recuperar los productos del carrito desde la sesión
    $cartItems = session()->get('cart', []);

    // Si deseas calcular el total del carrito, puedes hacerlo aquí
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity']; // Calcula el total
    }

    return view('comprador.cart', compact('cartItems', 'total'));
}


    public function checkout(Request $request)
    {
        // Lógica para procesar el pago o finalizar la compra
        // Por simplicidad, solo redirige a una página con un mensaje de éxito
        Session::forget('cart'); // Limpia el carrito
        return redirect()->route('comprador.index')->with('success', 'Compra realizada con éxito.');
    }
    public function update(Request $request, $productId)
{
    // Recuperar el carrito de la sesión
    $cart = session()->get('cart', []);

    // Verificar si el producto está en el carrito
    if (isset($cart[$productId])) {
        // Actualizar la cantidad
        $cart[$productId]['quantity'] = $request->input('quantity');
        
        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('comprador.cart.index')->with('success', 'Cantidad actualizada.');
    }

    return redirect()->route('comprador.cart.index')->with('error', 'El producto no se encuentra en el carrito.');
}

public function remove($productId)
{
    // Recuperar el carrito de la sesión
    $cart = session()->get('cart', []);

    // Verificar si el producto está en el carrito
    if (isset($cart[$productId])) {
        // Eliminar el producto del carrito
        unset($cart[$productId]);

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('comprador.cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    return redirect()->route('comprador.cart.index')->with('error', 'El producto no se encuentra en el carrito.');
}

}


