<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/escolha.css">
    <title>Escolher</title>
</head>
<body>
    <main>
        <div class="card">
      <div class="circle">👤</div>
      <a class="label" href="{{ route('cadastro.create') }}">Paciente</a>
      <p class="text1">Seja um paciente e<br>cuide de sua saúde<br>mental</p>
    </div>
 
    <div class="card">
      <div class="circle">🩺</div>
      <a class="label" href="{{ route('cadastromedico.create') }}">Médico</a>
      <p class="text2">Já é um médico?<br>Venha trabalhar<br>conosco e atenda<br>mais pacientes!</p>
    </div>
    </main>
</body>
</html>