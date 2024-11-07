@props(['label','name','inline',])
@if ($inline)
<div>
    <label for="">
        <input class="mr-3" type="checkbox" name="{{$name}}" {{ $attributes->merge([])}} id="" />{{$label}}
    </label>
</div>    
@else
<label for="">{{$label}}</label>
<input type="checkbox" name="{{$name}}" {{ $attributes->merge(['class'=>'block'])}} id="" />
@endif
