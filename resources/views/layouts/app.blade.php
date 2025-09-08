<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexus</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles.css') }}">
</head>


<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a>

            @auth
                <a href="{{ route('area.usuario') }}">Área do Usuário</a>
                <a href="{{ route('perfil') }}">Perfil</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('cadastro.create') }}">Cadastro</a>
            @endguest
        </nav>
    </header>

    <main>
    @if(session('success'))
        <div style="color: green; padding: 10px; margin-bottom: 15px; border: 1px solid green; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red; padding: 10px; margin-bottom: 15px; border: 1px solid red; border-radius: 5px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

    
</body>
</html>
