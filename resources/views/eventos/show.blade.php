@extends('layouts.main')

@section('title', $evento->titulo)

@section('content')


<div class="show-container-evento">
    <div class="show-evento-filho">
        <div>

            <img src="/img/eventos/{{$evento->imagem}}" class="show-imagem" alt="{{$evento->titulo}}">
        </div>
        <div class="show-container-sobre">
            <h5>Sobre o evento:</h5>
            <p>
                {{$evento->descricao}}
            </p>
        </div>
    </div>

    <div class="show-evento-filho">
        <h1>{{$evento->titulo}}</h1>
        <div>
            <p class="d-flex align-items-center">
                <span class="material-symbols-outlined">
                    location_on
                </span> <span>{{$evento->cidade}}</span>
            </p>
            <p class="d-flex align-items-center">
                <span class="material-symbols-outlined">
                    group
                </span><span>{{count($evento->users)}} Participantes</span>
            </p>
            <p class="d-flex align-items-center">
                <span class="material-symbols-outlined">
                    star
                </span><span>{{$donoEvento['name']}}</span>
            </p>
        </div>

        @if(!$hasUserJoined)
        <form action="/eventos/join/{{$evento->id}}" method="POST">
            @csrf
            <a href="/eventos/join/{{$evento->id}}" class="btn btn-success" onclick="event.preventDefault();
            this.closest('form').submit();">
                Confirmar Presença
            </a>
        </form>
        @else
        <p class="show-msg-participando-evento">Voce já está participando deste evento!</p>

        @endif
        <div>
            <h5>Evento conta com:</h5>
            @foreach($evento->itens_infraestrutura as $item)
            <ul>
                <li class="d-flex align-items-center"><span class="material-symbols-outlined">
                        play_arrow
                    </span>{{$item}}</li>
            </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection