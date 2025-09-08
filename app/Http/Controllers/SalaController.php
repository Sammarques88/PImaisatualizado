<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // Exibir o formulário de criação
    public function create()
    {
        return view('criar-salas');
    }
// No SalaController.php
public function index() {
    $salas = Sala::all();
    return view('salas', compact('salas'));
}

    // Salvar a nova sala no banco
    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer',
            'nome_medico' => 'required',
        ]);

        // Convertendo o valor de 'sim' para 1 e 'nao' para 0
        $laudo = $request->laudo === 'sim' ? 1 : 0;

        // Criar a sala no banco
        Sala::create([
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'numero_participantes' => $request->numero_participantes,
            'nome_medico' => $request->nome_medico,
            'laudo_obrigatorio' => $laudo,  // Passando o valor convertido
        ]);

        // Redirecionar ou retornar uma mensagem de sucesso
        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso!');
    }
}
