@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Escolha o tema da sala</h1>

    <form action="{{ route('sala.iniciar') }}" method="POST">
        @csrf
        <div>
            <label>
                <input type="radio" name="tema" value="ansiedade" checked>
                Ansiedade
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="tema" value="depressao">
                Depressão
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="tema" value="vicios">
                Vícios
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="tema" value="autocuidado">
                Autocuidado / Autoconhecimento
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Entrar na sala</button>
    </form>
</div>
@endsection
