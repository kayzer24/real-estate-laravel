@extends('admin.layout')

@section('title', $property->exists ? 'Editer un bien': 'Créer un nouveau bien');

@section('content')
    <h1>@yield('title')</h1>
<div class="row">
    <div class="col-10">
        <form class="vstack gap-2"
              action="{{route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}"
              method="post"
              enctype="multipart/form-data"
        >
            @csrf
            @method($property->exists ? 'PUT' : 'POST')

            <div class="row">
                @include('shared.input', ['class' => 'col', 'name' => 'title', 'value' => $property->title])

                <div class="col row">
                    @include('shared.input', ['class' => 'col', 'name' => 'surface', 'value' => $property->surface])
                    @include('shared.input', ['class' => 'col', 'label' => 'Prix', 'name' => 'price', 'value' => $property->price])
                </div>
            </div>

            @include('shared.input', ['type' => 'textarea', 'name' => 'description', 'value' => $property->description])

            <div class="row">
                @include('shared.input', ['class' => 'col', 'label' => 'Pièces', 'name' => 'rooms', 'value' => $property->rooms])
                @include('shared.input', ['class' => 'col', 'label' => 'Chambres', 'name' => 'bedrooms', 'value' => $property->bedrooms])
                @include('shared.input', ['class' => 'col', 'label' => 'Etages', 'name' => 'floor', 'value' => $property->floor])
            </div>

            <div class="row">
                @include('shared.input', ['class' => 'col', 'label' => 'Adresse', 'name' => 'address', 'value' => $property->address])
                @include('shared.input', ['class' => 'col', 'label' => 'Ville', 'name' => 'city', 'value' => $property->city])
                @include('shared.input', ['class' => 'col', 'label' => 'Code Postal', 'name' => 'postal_code', 'value' => $property->postal_code])
            </div>
            @include('shared.select', ['label' => 'Options', 'name' => 'options', 'value' => $property->options()->pluck('id'), 'multiple' => true, 'options' => $options])

            @include('shared.checkbox', ['label' => 'Vendu', 'name' => 'sold', 'value' => $property->sold])

            @include('shared.input', ['type' => 'file', 'label' => 'Images', 'name' => 'pictures', 'multiple' => true])

{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="pictures">Images</label>--}}
{{--                        <input type="file" name="pictures[]" id="pictures"--}}
{{--                               class="form-control @error('pictures') is-invalid @enderror" multiple accept="image/*" value="">--}}
{{--                        @error('pictures')--}}
{{--                        <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div>
                <button class="btn btn-primary">
                    @if($property->exists)
                        Modifier
                    @else
                        Créer
                    @endif
                </button>
            </div>
        </form>
    </div>
    <div class="col-2">
        @if($property->exists && $property->pictures->count() > 0)
            <div class="row">
                @foreach($property->pictures as $picture)
                    <div class="col-12 mb-3 position-relative">
                        <img src="{{ $picture->getImageUrl(200, 150) }}" alt="" class="w-100"
                             style="object-fit: cover;">
                        <form action="{{ route('admin.picture.destroy', $picture) }}" method="post"
                              class="position-absolute" style="top: -10px; right: 0;">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger rounded-circle badge">×</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
