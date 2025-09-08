@extends('layouts.app')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Perfil de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e3e1e1;
            margin: 0;
            padding: 0;
        }
        .perfil-container {
            background-color: #fff;
            max-width: 800px;
            max-height: 1030px;
            margin: 40px auto;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .perfil-foto {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 2px solid #007bff;
        }
        .perfil-nome {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .perfil-email {
            color: #555;
            margin-bottom: 20px;
        }
        .perfil-info {
            text-align: left;
            margin-top: 20px;
        }
        .perfil-info strong {
            display: inline-block;
            width: 90px;
        }
        .editar-btn {
            margin-top: 20px;
            padding: 8px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            

        }
        .editar-btn:hover {
            background: #0056b3;
        }
        .button {
    display: inline-block;
    background-color: #007bff;
    margin: 10px;
    color: white;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s ease;
        }
        .button1 {
            display: inline-block;
    background-color: #cf0404;
    margin: 10px;
    color: white;
    padding: 12px 30px;
    border-radius: 10px;
    border-color: #cf0404;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s ease;

        } 
        .button1:hover {
            background-color: #ff0303;
        }

        .button:hover {
            background-color: #6af3c3;
        }
        
    </style>
</head>
@section ('content')
        
<body>
    
    <div class="perfil-container">
          <h1 class="text-center my-4">Perfil de Usuário</h1>
        <img src="{{ asset('SRC/regullus.jpg') }}" alt="Foto do Usuário" class="perfil-foto">
        <div class="perfil-nome">Regullus Corneas</div>
        <div class="perfil-email">RegullusCorneas@email.com</div>
            <br>
            <div><strong>Idade:</strong> 428</div>
            <div><strong>Cidade:</strong> São Paulo</div>
            <div><strong>Telefone:</strong> (11) 99999-9999</div>
            <div><strong>Senha:</strong> *************</div>
        
        
        <a class="button" href="{{ route('home') }}">Editar Perfil</a>
        <a class="button"href="{{ route('cadastrolaudo') }}">Cadastrar Laudo</a>
        <a class="button"href="{{ route('home') }}">Ver Laudos</a>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="button1" type="submit" class="logout-btn">Desconectar</button>
</form>
            
    </div>
    </div>
    @endsection ('content')
</body>

        
</html>