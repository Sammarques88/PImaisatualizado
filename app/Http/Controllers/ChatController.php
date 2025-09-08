<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
{
    return view('chat', ['temaSelecionado' => 'ansiedade']);

}

public function showChat()
{
    $temaSelecionado = session('tema'); // ou vindo de banco
    $pauta = session('pauta'); // ou vindo de banco, se o moderador salvou

    return view('chat', compact('temaSelecionado', 'pauta'));
}




}

