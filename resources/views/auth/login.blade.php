@extends('base')
@section('title', 'Se Connecter')

@section('content')
    <div class="container mt-4">
        <h1>@yield('title')</h1>

        @include('shared.flash')

        <form action="{{route('login')}}" method="post" class="vstack gap-2">
            @csrf
            @method('post')

            <div class="form-group mb-3">
                @include('shared.input', ['type' => 'email', 'name' => 'email'])
                @include('shared.input', ['type' => 'password', 'name' => 'password', 'label' => 'Mot de passe'])
            </div>

            @include('shared.checkbox', ['label' => 'Se souvenir de moi', 'name' => 'remember_me'])


            <button class="btn btn-primary" type="submit">Se Connecter</button>
        </form>
    </div>
@endsection
