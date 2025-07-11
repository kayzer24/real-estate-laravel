@extends('base')

@section('title', $property->title)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                <div class="carousel slide" id="carousel" data-bs-ride="carousel" style="max-width: 800px">
                    <div class="carousel-indicators">
                        @foreach($property->pictures->pluck('id') as $k => $v)
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$k}}" class="{{$k === 0 ? 'active':''}}" aria-current="true" aria-label="Slide {{$k}}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @forelse($property->pictures as $k => $picture)
                            <div @class(["carousel-item", "active" => $k === 0 ])>
                                <img src="{{ $picture->getImageUrl(400, 400) }}" alt="..." style="width:100%; height:600px; object-fit: cover;">
                            </div>
                        @empty
                            <div @class(["carousel-item", "active" ])>
                                <img src="{{ asset('images/empty.jpg') }}" alt="" style="width:100%; height: 600px; object-fit: cover;">
                            </div>
                        @endforelse
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-4">
                <h1>@yield('title')</h1>
                <h2>{{ $property->rooms }} pièces - {{ $property->surface }} m²</h2>

                <div class="text-primary fw-b" style="font-size: 4rem">
                    {{ number_format($property->price, thousands_separator: ' ') }} €
                </div>
                <hr>
                <div class="mt-4">
                    <h4>Intéressé par ce bien?</h4>

                    @include('shared.flash')

                    <form action="{{route('property.contact', $property)}}" method="post" class="vstack gap-3">
                        @csrf
                        <div class="row">
                            <x-input class="col" name="firstname" label="Prénom"/>
                            <x-input class="col" name="lastname" label="Nom"/>
                        </div>
                        <div class="row">
                            <x-input type="tel" class="col" name="phone" label="Téléphone"/>
                            <x-input type="email" class="col" name="email" />
                        </div>
                        <div class="form-group">
                            <x-input type="textarea" class="col" name="message"/>
                        </div>
                        <div>
                            <button class="btn btn-primary">Nous contacter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <p>{{nl2br( $property->description) }}</p>
            <div class="row">
                <div class="col-8">
                    <h2>Caractérestiques</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>Surface Habitable</td>
                            <td>{{$property->surface}}m²</td>
                        </tr>
                        <tr>
                            <td>Pièces</td>
                            <td>{{$property->rooms}}m²</td>
                        </tr>
                        <tr>
                            <td>Chambres</td>
                            <td>{{$property->bedrooms}}m²</td>
                        </tr>
                        <tr>
                            <td>Etage</td>
                            <td>{{$property->floor ?: 'Rez de chaussé' }}</td>
                        </tr>
                        <tr>
                            <td>Localisation</td>
                            <td>{{$property->city}} ({{$property->postal_code}})</td>
                        </tr>
                    </table>
                </div>
                <div class="col-4">
                    <h2>Spécificités</h2>
                    <ul class="list-group">
                        @forelse($property->options as $option)
                            <li class="list-group-item">{{$option->name}}</li>
                        @empty
                            <li class="list-group-item">Vide</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
