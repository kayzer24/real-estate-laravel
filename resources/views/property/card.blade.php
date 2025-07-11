<div class="card">
    @if($property->getPicture())
        <img src="{{ $property->getPicture()?->getImageUrl(800, 400) }}" alt="" class="card-img-top"
             style="height: 200px; object-fit: cover;">
    @else
        <img src="{{ asset('images/empty.jpg') }}" alt="" class="card-img-top"
             style="height: 200px; object-fit: cover;">
    @endif
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{route('property.show', [ 'slug' => $property->getSlug(), 'property' => $property ])}}">{{ $property->title }}</a>
        </h5>
        <p class="card-text">{{$property->surface}}m² - {{ $property->city }} ({{ $property->postal_code }})</p>
        @if($property->options)
            @foreach($property->options as $option)
                <small><span class="badge text-bg-success">{{$option->name}}</span></small>
            @endforeach
        @endif
        <div class="text-primary fw-b" style="font-size: 1.4rem; font-weight: bold;">
            {{ number_format($property->price, thousands_separator: ' ') }} €
        </div>

        @if($property->sold)
            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">
            Vendu
        </span>
        @endif

    </div>
</div>
