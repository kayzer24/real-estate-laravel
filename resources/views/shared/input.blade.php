@php
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);
    $multiple ??= false
@endphp

<div @class(["form-group", $class])>
    <label for="{{$name}}">{{$label}}</label>
    @if($type === 'textarea')
        <textarea class="form-control  @error($name) is-invalid @enderror"
               id="{{$name}}"
               name="{{$name}}"
        >{{old($name, $value)}}</textarea>
    @elseif($type === 'file')
        <input class="form-control  @error($name) is-invalid @enderror"
               type="{{$type}}"
               id="{{$name}}"
               name="{{$name}}@if($multiple)[]@endif"
               value="{{old($name, $value)}}"
               {{$multiple ? 'multiple':''}}
        >
    @else
        <input class="form-control  @error($name) is-invalid @enderror"
               type="{{$type}}"
               id="{{$name}}"
               name="{{$name}}"
               value="{{old($name, $value)}}"
        >
    @endif


    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
