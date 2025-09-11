<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Tela de seleção da sala.
     */
    public function index()
    {
        // lista de temas disponíveis
        $temas = [
            'ansiedade' => 'Ansiedade',
            'depressao' => 'Depressão',
            'vicios' => 'Vícios',
            'autocuidado' => 'Autocuidado/Autoconhecimento',
        ];

        return view('sala', compact('temas'));
    }

    /**
     * Processa seleção e redireciona para o chat.
     */
    public function iniciar(Request $request)
    {
        $request->validate([
            'tema' => 'required|in:ansiedade,depressao,vicios,autocuidado',
        ]);

        $tema = $request->input('tema');

        // redireciona para rota do chat já com o tema
        return redirect()->route('chat.index', ['tema' => $tema]);
    }
}
