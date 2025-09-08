<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        // Exibe a tela de seleção de tema
        return view('sala');
    }

    public function iniciar(Request $request)
    {
        $request->validate([
            'tema' => 'required|in:ansiedade,depressao,vicios,autoajuda',
        ]);

        // Redireciona para a tela do chat passando o tema
        return redirect()->route('chat', ['tema' => $request->tema]);
    }
}
