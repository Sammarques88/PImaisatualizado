    @extends ('layouts.app')

    @section ('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles-sobre.css') }}">
</head>

<body>

    <container class="sobre">
        <div class="imagem">
            <img src="{{ asset('SRC/sala-imagem.png') }}" alt="Equipe ou empresa">
        </div>
        <div class="conteudo">
            <h2>Quem somos</h2>
            <p>A Conxeus é uma plataforma virtual e anônima para pessoas que buscam apoio emocional. Oferece um espaço seguro para desabafar, com reuniões conduzidas por profissionais, promovendo a interação e a inclusão.</p>

            <h2>Missão</h2>
            <p>A missão da Conxeus é fornecer um espaço online seguro e anônimo para que pessoas com dificuldades emocionais possam se conectar, desabafar e receber apoio de profissionais, promovendo a saúde mental e o bem-estar.</p>

            <h2>Visão</h2>
            <p>A visão de longo prazo da Conxeus é se tornar a principal plataforma de apoio emocional online, reconhecida por oferecer um ambiente seguro e inclusivo, onde a saúde mental é acessível e a conexão humana transforma vidas.</p>
        </div>
    </container>

</body>
</html>

 @endsection ('content')