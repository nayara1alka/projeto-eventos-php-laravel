@extends('layouts.main')

@section('title', 'Eventos')

@section('content')
<div class="mb-3">

  <div class="container-search">
    <div class="container-search-titulo">
      <h2 class="welcome-titulo-search">Busque por um evento</h2>
      <form action="/" method="GET" class="container-formulario-search">
        <input type="text" placeholder="Pesquisar..." name="search" class="form-control">
      </form>
    </div>
  </div>

  @if($search)
  <h1 class="welcome-titulo">Buscando por: {{$search}}</h1>
  @else
  <h1 class="welcome-titulo">Próximos Eventos</h1>
  @endif

  <div class="welcome-container-card ">
    @foreach($eventos as $evento)

    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="/img/eventos\{{$evento->imagem}}" alt="{{$evento->titulo}}">
      <div class="card-body">
        <p>{{date('d/m/Y', strtotime($evento->data))}}</p>
        <h5 class="card-title">{{ $evento->titulo }}</h5>
        <p class="card-text">{{count($evento->users)}} Participantes</p>
        <a href="/eventos/{{$evento->id}}" class="btn cor-fundo-primaria">Saiba mais</a>
      </div>
    </div>
    @endforeach
  </div>

  @if(count($eventos) == 0 && $search)
  <p>
    Não foi possível encontrar nenhum evento com {{$search}}!
    <a href="/">Ver todos</a>
  </p>
  @elseif(count($eventos) == 0)
  <p>Não há eventos disponíveis</p>
  @endif
</div>

@endsection