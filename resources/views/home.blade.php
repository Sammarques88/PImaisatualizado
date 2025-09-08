@extends('layouts.app')
 
@section('content')
<!DOCTYPE html>
<html lang="pt-br">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./img/img.png.png">
    <link rel="stylesheet" href="{{ asset('CSS/styles-home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Conexus</title>
   
</head>
 
    <!-- -->
<body>
  <h4 class="text-h4"><strong>Seja bem-vindo à C<span class="string-span">o</span>nexus</strong></h4>
 
    <!-- Slider -->
    <div class="container-slider">
        <button id="prev-button"><img src="{{ asset('SRC/arrow.png') }}" alt="prev-button"></button>
        <div class="container-images">
        <img src="https://www.escoladainteligencia.com.br/wp-content/uploads/2016/09/O-poder-da-empatia-como-ela-impacta-a-vida-das-pessoas-2.jpg" alt="girl" class="slider on">
        <img src="{{ asset('SRC/Img-chat-reunião.jpg') }}" alt="chat" class="slider">
        <img src="{{ asset('SRC/conexao-empatia.jpg') }}" alt="hands" class="slider">
        </div>
        <button id="next-button"><img src="{{ asset('SRC/arrow.png') }}" alt="next-button"></button>
    </div>
 
    <script src="{{ asset('JS/slide.js') }}"></script>
 
    <main>
        <section class="home">
 
            <!-- TEXTO -->
            <div class="home-text">
                <h1 class="text-h1">Porque todo mundo precisa de um lugar para se <br><strong>"conectar"</strong></h1>
                <p>
                    <br>
                    <strong>Nossa plataforma promove a interação entre pessoas, com um olhar atencioso e
                        acolhedor para quem enfrenta desafios emocionais. Em um ambiente virtual anônimo e seguro,
                        todos podem se sentir à vontade para desabafar, refletir e compartilhar sentimentos,
                        encontrando apoio com respeito, empatia e sem julgamentos.</strong>
                </p>
                <a href="{{ route('login') }}" class="home-btn">Cadastre-se ou Faça Login</a>
            </div>
 
            <!-- CARDS -->
            <div class="cards-container">
                <a href="#card1" class="card">
                    <img src="{{ asset('SRC/Saúde Mental.png') }}" alt="Cérebro com coração" />
                    <p><strong>Aqui, você se conecta com pessoas que sabem ouvir, que compartilham histórias, que
                            acolhem sem perguntas estranhas ou olhares tortos.
                            É um lugar pra conversar de verdade, sem máscaras, sem julgamentos.</strong></p>
                </a>
                <a href="#card2" class="card">
                    <img src="{{ asset('SRC/card2.png') }}" alt="Mãos com cérebro" />
                    <p><strong>Nós não queremos parecer uma plataforma “séria demais”. O que nós queremos ser aquele é
                            lugar que você busca
                            quando precisa de verdade — pra ser ouvido, pra pensar alto, pra lembrar que você não tá
                            sozinho.</strong></p>
                </a>
                <a href="#card3" class="card">
                    <img src="{{ asset('SRC/card3.png') }}" alt="Pessoa com letra C - Conexus" />
                    <p><strong>Porque no fim das contas, todo mundo precisa se conectar... com outras pessoas, consigo
                            mesmo,
                            com a vida... E é por isso que estamos aqui...
                            É por isso que somos a CONEXUS.</strong></p>
                </a>
            </div>
        </section>
 
        <container class="back-video">
            <div class="home-video">
                <video id="narracao" play muted playsinline>
                    <source src="{{ asset('SRC/narracao.mp4') }}" type="video/mp4">
                    Seu navegador não suporta vídeo.
                </video>
                <button id="audio-btn">🔊 Ativar som</button>
            </div>
        </container>
 
    </main>
 
    <script>
    const video = document.getElementById('narracao');
    const audioBtn = document.getElementById('audio-btn');
    let isMuted = true;
 
    video.addEventListener('click', () => {
        if (video.paused || video.ended) {
            video.play();
        } else {
            video.pause();
        }
    });
 
    audioBtn.addEventListener('click', () => {
        isMuted = !isMuted;
        video.muted = isMuted;
        audioBtn.textContent = isMuted ? "🔇 Ativar som" : "🔊 Desativar som";
        video.play();
    });
    </script>
 
</body>
   
    @endsection