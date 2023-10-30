@extends('layouts.main')

@section('title', 'Editando Evento: ' . $evento->titulo)

@section('content')

<h1>Editando: {{$evento->titulo}}</h1>
<form action="/eventos/atualizar/{{$evento->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="imagem">Imagem do Evento:</label>
        <input type="file" name="imagem" class="form-control-type" id="imagem">
        <img src="/img/eventos/{{$evento->imagem}}" alt="{{$evento->titulo}}" class="editar-imagem">
    </div>

    <div class="form-group mt-3">
        <label for="evento">Evento</label>
        <input type="text" name="titulo" class="form-control" id="evento" placeholder="Nome" value="{{$evento->titulo}}">
    </div>

    <div class="form-group mt-3">
        <label for="data">Data do Evento</label>
        <input type="date" name="data" class="form-control" id="data" value="{{$evento->data->format('Y-m-d')}}">
    </div>

    <div class="form-group mt-3">
        <label for="cidade">Cidade</label>
        <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Local do evento" value="{{$evento->cidade}}">
    </div>
    <div class="form-group mt-3">
        <label for="privado">O evento é privado?</label>
        <select name="privado" class="form-control" id="privado">
            <option value="0">Não</option>
            <option value="1" {{$evento->privado == 1 ? "selected='select'" : ''}}>Sim</option>
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="descricao">Descrição</label>
        <textarea type="text" name="descricao" rows="3" class="form-control" id="descricao" placeholder="Oque vai acontecer no evento?">
        {{$evento->descricao}}
        </textarea>
    </div>

    <div class="form-group mt-3">
        <label>Adicione itens de infraestrutura</label>

        <div class="form-group form-check">
            <label class="form-check-label" for="cadeiras">Cadeiras</label>
            <input type="checkbox" name="itens_infraestrutura[]" value="Cadeiras" class="form-check-input" id="cadeiras">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label" for="palco">Palco</label>
            <input type="checkbox" name="itens_infraestrutura[]" value="Palco" class="form-check-input" id="palco">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label" for="brindes">Brindes</label>
            <input type="checkbox" name="itens_infraestrutura[]" value="Brindes" class="form-check-input" id="brindes">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label" for="openFood">Open Food</label>
            <input type="checkbox" name="itens_infraestrutura[]" value="Open Food" class="form-check-input" id="openFood">
        </div>
    </div>

    <button type="submit" class="btn cor-fundo-primaria mt-3 mb-3">Editar Evento</button>
</form>

@endsection