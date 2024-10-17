<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuyerController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', function () {
    return view('auth.login'); // Vista de inicio de sesión
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rutas de registro
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Rutas para el dashboard principal
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Vista genérica del dashboard
    })->name('dashboard');

    // Rutas para los dashboards según el rol
    Route::get('/vendedor/dashboard', function () {
        return view('vendedor.dashboard'); // Vista del dashboard del vendedor
    })->name('vendedor.dashboard');

    Route::get('/comprador/dashboard', function () {
        return view('comprador.dashboard'); // Vista del dashboard del comprador
    })->name('comprador.dashboard');
});

// Rutas del comprador
Route::middleware(['auth'])->group(function () {
    Route::get('/comprador', [BuyerController::class, 'index'])->name('comprador.index'); // Vista de productos

    // Rutas para el carrito
    Route::post('/comprador/cart/add/{product}', [CartController::class, 'add'])->name('comprador.cart.add'); // Agregar producto al carrito
    Route::get('/comprador/cart', [CartController::class, 'index'])->name('comprador.cart.index'); // Vista del carrito
    Route::post('/comprador/cart/update/{productId}', [CartController::class, 'update'])->name('comprador.cart.update');
    Route::post('/comprador/cart/checkout', [CartController::class, 'checkout'])->name('comprador.cart.checkout'); // Checkout
    Route::post('/comprador/cart/remove/{productId}', [CartController::class, 'remove'])->name('comprador.cart.remove');

});

// Rutas del vendedor
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('vendedor/products')->name('vendedor.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index'); // Listar productos
        Route::get('/create', [ProductController::class, 'create'])->name('create'); // Crear producto
        Route::post('/', [ProductController::class, 'store'])->name('store'); // Almacenar producto
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit'); // Editar producto
        Route::put('/{product}', [ProductController::class, 'update'])->name('update'); // Actualizar producto
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy'); // Eliminar producto
    });
});
