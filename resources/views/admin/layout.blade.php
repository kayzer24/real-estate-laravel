<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title') | Administration</title>

    <style>
        @layer reset {
            button {
                all:unset;
            }
        }
    </style>
</head>
<body>
@php
    $routeName = request()->route()->getName()
@endphp

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">Agence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{route('admin.property.index')}}" @class(['nav-link', 'active' => str_contains($routeName, 'property.')]) aria-current="page">Gérer les biens</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.option.index')}}" @class(['nav-link', 'active' => str_contains($routeName, 'option.')]) aria-current="page">Gérer les option</a>
                </li>
            </ul>
            <div class="ms-auto">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="nav-link">Se déconnecter</button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="container mt-5">
    @include('shared.flash')

    @yield('content')
</main>

</body>
</html>
