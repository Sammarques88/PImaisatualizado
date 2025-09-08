<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class MedicoController extends Controller
{
    public function create()
    {
        return view('cadastromedico');
    }

    public function store(Request $request)
    
    {
        
        // 1. Validar TODOS os campos que vêm do formulário de médico
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'unique:usuarios,cpf'],
            'especialidade' => ['required', 'string', 'max:100'],
            'crm' => ['required', 'string', 'max:20', 'unique:medicos,crm'],
            'telefone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
      

        // Usamos uma transação para garantir a integridade: ou salva os dois, ou não salva nenhum.
        DB::beginTransaction();
        try {
            // 2. Criar o USUÁRIO com os dados comuns e de login
            $usuario = Usuario::create([
                'name' => $request->nome,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 3. Criar o MÉDICO com os dados específicos, ligando ao usuário recém-criado
            $medico = Medico::create([
                'usuario_id' => $usuario->id, // A "cola" entre as duas tabelas
                'especialidade' => $request->especialidade,
                'crm' => $request->crm,
            ]);

            DB::commit(); // Se tudo deu certo, confirma a operação no banco

            // Opcional: fazer login do médico recém-cadastrado
            // Auth::login($usuario);

            return redirect()->route('home')->with('success', 'Cadastro de médico realizado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($request->all()); // Se algo deu errado, desfaz tudo
            // Para depuração, você pode querer ver o erro: dd($e->getMessage());
            return back()->with('error', 'Houve um erro ao realizar o cadastro. Por favor, tente novamente.')->withInput();
        }
    }
}