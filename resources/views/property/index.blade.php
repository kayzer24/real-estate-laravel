@extends('base')

@section('title', 'tous nos biens')

@section('content')
    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="get" class="container d-flex gap-2">
            <input type="number" placeholder="Surface min" class="form-control" name="surface" value="{{$input['surface'] ?? ''}}" >
            <input type="number" placeholder="Pièces min" class="form-control" name="rooms" value="{{$input['rooms'] ?? ''}}" >
            <input type="number" placeholder="Budget max" class="form-control" name="price" value="{{$input['price'] ?? ''}}" >
            <input placeholder="Mots Clé" class="form-control" name="title" value="{{$input['title'] ?? ''}}">
            <button class="btn btn-primary btn-sm flex-grow-0">Rechercher</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-3 mb-3">
                    @include('property.card')
                </div>
            @empty
                <div class="col text-center">
                    Aucun bien ne correspond a votre recherche
                </div>
            @endforelse
        </div>

        <div class="my-4">
            {{ $properties->links() }}
        </div>
    </div>

@endsection
