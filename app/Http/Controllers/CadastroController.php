<?php

namespace App\Http\Controllers;

// Importe o seu Request de validação, que vamos renomear para CadastroRequest
use App\Http\Requests\CadastroRequest; // <<-- MUDANÇA AQUI
use Illuminate\Http\Request; // Não é mais necessário para o store se usar o CadastroRequest, mas pode ser útil para outros métodos.
use App\Models\Usuario; // <<-- MUDANÇA AQUI: Vamos criar este novo Model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Para depuração de erros

class CadastroController extends Controller
{
    /**
     * Exibe o formulário de cadastro.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Esta view deve ser o seu 'cadastro.blade.php'
        return view('cadastro');
    }

    /**
     * Processa os dados do formulário de cadastro e salva no banco de dados.
     *
     * @param  \App\Http\Requests\CadastroRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CadastroRequest $request) // <<-- MUDANÇA AQUI: Usando o CadastroRequest
    {
        // Se a validação do CadastroRequest falhar, o Laravel redireciona automaticamente
        // de volta com os erros e os dados antigos (`old()`).

        try {
            // Cria um novo registro na tabela 'usuarios' usando o Model Usuario
            $usuario = Usuario::create([ // <<-- MUDANÇA AQUI: Criando um Usuario
                'name' => $request->name,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'password' => Hash::make($request->senha), // <<-- MUDANÇA AQUI: O campo é 'senha' no formulário
            ]);

            // Opcional: Autenticar o usuário recém-cadastrado
            // auth()->login($usuario);

            // Redireciona para a home com uma mensagem de sucesso
            return redirect('/')->with('success', 'Cadastro realizado com sucesso! Bem-vindo(a) à Conexus.');

        } catch (\Exception $e) {
            // Registra o erro detalhadamente no log do Laravel
            Log::error('Erro ao cadastrar usuário: ' . $e->getMessage() . ' - Dados: ' . json_encode($request->all()));

            // Redireciona de volta com uma mensagem de erro genérica
            return back()->withInput()->withErrors(['cadastro' => 'Erro ao realizar cadastro. Por favor, tente novamente.']);
        }
    }

    // Os métodos 'rules()' e 'messages()' estavam duplicados aqui e devem ser APENAS no Request.
    // Os métodos 'showRegistrationForm()' e 'register()' parecem ser resquícios de um AuthController padrão.
    // Se o seu objetivo é ter apenas um fluxo de cadastro personalizado, eles podem ser removidos.
    // Vamos manter o 'create' para exibir o formulário e 'store' para salvar.
}