<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!--Material Icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--Fonte do google-->

    <!--CSS do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--CSS da aplicação-->
    <link rel="stylesheet" href="/css/styles.css" />
    <script src="/js/scripts.js"></script>
</head>

<body class="container">
    <header class="header-projeto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="/">
                    <img src="/img/logo.svg" alt="" width="50" height="50" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eventos/criar">Criar Eventos</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Meus Eventos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a class="nav-link" href="/logout" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    Sair
                                </a>
                            </form>
                        </li>
                        @endauth

                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div>
            @if(session('msg'))
            <p class="container-flash-messages">{{session('msg')}}</p>
            @endif
            @yield('content')
        </div>
    </main>
</body>

</html>