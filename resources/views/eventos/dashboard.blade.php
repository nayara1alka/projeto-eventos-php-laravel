@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<h1 class="mb-4">
  Meus Eventos
</h1>

@if(count($eventos) > 0)

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Participantes</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>

    @foreach($eventos as $evento)
    <tr>
      <th scope="row">{{$loop->index + 1}}</th>
      <td><a href="/eventos/{{$evento->id}}">{{$evento->titulo}}</a></td>
      <td>{{count($evento->users) }}</td>
      <td class="meus-eventos-container-acoes">
        <button class="btn cor-fundo-primaria">
          <a class="link-editar" href="/eventos/editar/{{$evento->id}}">Editar</a>
        </button>
        <form action="/eventos/{{$evento->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">
            Deletar
          </button>

        </form>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@else
<p>Você ainda não tem eventos, <a href="/eventos/criar">Criar Evento</a></p>
@endif

<h1 class="mt-4 mb-4">
  Eventos que estou participando
</h1>

@if(count($eventosParticipante) > 0)

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Participantes</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>

    @foreach($eventosParticipante as $evento)
    <tr>
      <th scope="row">{{$loop->index + 1}}</th>
      <td><a href="/eventos/{{$evento->id}}">{{$evento->titulo}}</a></td>
      <td>{{count($evento->users) }}</td>
      <td>
        <form action="/eventos/leave/{{$evento->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">
            Sair do Evento
          </button>
        </form>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@else
<p>Voce ainda nao está participando de nenhum evento, <a href="/">veja todos os eventos</a> </p>

@endif

@endsection