<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerar la sesión
            $request->session()->regenerate();

            // Verificar el rol del usuario autenticado
            $user = Auth::user();  // Obtenemos el usuario autenticado
            
            // Redirigir según el rol del usuario
            if ($user->role === 'vendedor') {
                return redirect()->intended(route('vendedor.dashboard'));
            } elseif ($user->role === 'comprador') {
                return redirect()->intended(route('comprador.dashboard'));
            }
        }

        // Si la autenticación falla, redirigir de nuevo con error
        return back()->withErrors([
            'login' => 'Las credenciales son incorrectas.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
{
    try {
        // Invalida la sesión actual
        $request->session()->invalidate();
        
        // Regenera el token de la sesión para evitar CSRF
        $request->session()->regenerateToken();

        // Cierra la sesión
        Auth::logout();

        // Redirige a la página principal
        return redirect('/'); // Cambia esto si deseas redirigir a otra ruta
    } catch (\Exception $e) {
        // Si ocurre un error, redirige con un mensaje de error
        return redirect('/')->withErrors(['logout' => 'Error al cerrar sesión.']);
    }
}

}
