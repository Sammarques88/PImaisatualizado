@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/criar-salas.css') }}">

  <main>
    <section class="formulario-sala">
       <center><h1>Criar Nova Sala</h1></center>

      <form method="POST" action="{{ isset($sala) ? route('salas.update', $sala->id) : route('salas.store') }}">
  @csrf
  @if(isset($sala))
    @method('PUT')
  @endif

  <label for="tema">Tema da Sala:</label>
  <input type="text" id="tema" name="tema" placeholder="Tema que o doutor quer conversar" value="{{ old('tema', $sala->tema ?? '') }}" required />

  <label for="descricao">Descrição (opcional):</label>
  <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o objetivo da sala...">{{ old('descricao', $sala->descricao ?? '') }}</textarea>

  <label for="data">Data:</label>
  <input type="date" id="data" name="data" value="{{ old('data', $sala->data ?? '') }}" required />

  <label for="hora">Hora:</label>
  <input type="time" id="hora" name="hora" value="{{ old('hora', $sala->hora ?? '') }}" required />

  <label for="numero_participantes">Número de Participantes:</label>
  <input type="number" id="numero_participantes" name="numero_participantes" min="2" max="8" value="{{ old('numero_participantes', $sala->numero_participantes ?? '') }}" required />

  <label for="nome_medico">Nome do Médico:</label>
  <input type="text" id="nome_medico" name="nome_medico" value="{{ old('nome_medico', $sala->nome_medico ?? '') }}" required />

  <label for="laudo">Laudo Obrigatório:</label>
  <select id="laudo" name="laudo" required>
    <option value="1" {{ old('laudo', $sala->laudo_obrigatorio ?? '') == 1 ? 'selected' : '' }}>Sim</option>
<option value="0" {{ old('laudo', $sala->laudo_obrigatorio ?? '') == 0 ? 'selected' : '' }}>Não</option>

  </select>

  <button type="submit">
    {{ isset($sala) ? 'Salvar alterações' : 'Criar sala' }}
  </button>
</form>
    </section>
  </main>
@endsection