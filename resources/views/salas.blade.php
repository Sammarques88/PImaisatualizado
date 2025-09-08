<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Sala de Chat</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto; text-align:center;">
        <h2>Selecione o Tema da Sala</h2>
        
        <form action="{{ route('sala.iniciar') }}" method="POST">
            @csrf
            <select name="tema" required style="padding:10px; margin:20px 0; width:100%;">
                <option value="">-- Escolha um tema --</option>
                <option value="ansiedade">Ansiedade</option>
                <option value="depressao">Depressão</option>
                <option value="vicios">Vícios</option>
                <option value="autoajuda">Autoajuda / Autoconhecimento</option>
            </select>
            
            <button type="submit" style="padding:10px 20px; background:#007BFF; color:#fff; border:none; cursor:pointer;">
                Iniciar Chat
            </button>
        </form>
    </div>
</body>
</html>
