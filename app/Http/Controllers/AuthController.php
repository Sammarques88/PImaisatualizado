<?php

namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Autenticação usando o guard padrão "web"
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('area-usuario'); // corrigi aqui, pra usar a rota correta
        }

        return back()->withErrors([
            'email' => 'Email ou senha incorretos.',
        ])->withInput();
    }

    // Faz logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home') // <-- agora vai para Home
                         ->with('success', 'Você saiu da conta com sucesso!');
    }
}
