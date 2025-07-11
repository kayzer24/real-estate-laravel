<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    --}}{{--    Bootstrap 5--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3.7/examples/carousel/carousel.css">--}}
    <title>@yield('title') | Mon Agence</title>
</head>
<body>
@php
    $routeName = request()->route()->getName()
@endphp

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">Agence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{route('property.index')}}"
                       @class(['nav-link', 'active' => str_starts_with($routeName, 'property.')])
                       aria-current="page"
                    >
                        Les biens
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>--}}
</body>
</html>
