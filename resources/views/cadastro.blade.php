
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Conexus</title>
    {{-- Isso garante que o caminho para o CSS esteja correto --}}
    <link rel="stylesheet" href="{{ asset('CSS/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="form-container">
            <h1 class="logo">C<span class="logo-o">o</span>nexus</h1>
            <h2>Crie sua conta</h2>
            <p>Junte-se à nossa comunidade para compartilhar experiências.</p>
            <form action="{{ route('cadastro.store') }}" method="POST">
                <form action="{{ route('cadastro.store') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger" style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Seus input-groups existentes --}}

    <div class="input-group">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required value="{{ old('name') }}">
    </div>

    <div class="input-group">
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" inputmode="numeric" placeholder="Apenas números" required value="{{ old('cpf') }}">
    </div>

    <div class="input-group">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" inputmode="numeric" placeholder="Apenas números" required value="{{ old('telefone') }}">
    </div>

    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required value="{{ old('email') }}">
    </div>

    <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Crie uma senha segura" required>
    </div>

    <div class="input-group">
        <label for="confirmar-senha">Confirmar a senha</label>
        <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Confirme sua senha" required>
    </div>

    <div class="checkbox-group">
        <input type="checkbox" id="termos" name="termos" required {{ old('termos') ? 'checked' : '' }}>
        <label for="termos">Eu li e concordo com os <a href="{{ route('termos') }}" target="_blank">Termos de Serviço</a>.</label>
    </div>

    <button type="submit" class="submit-btn">Cadastrar</button>
    </form>
            <p class="login-link">Já tem uma conta? <a href="{{ route('login') }}">Faça login</a></p>
            <p class="login-link">Voltar para o <a href="{{ route('home') }}">Inicio</a></p>
        </div>
    </div>

    
    <script src="{{ asset('js/masks.js') }}"></script>
    
</body>
</html>