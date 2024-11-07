@props(['active'=> false])
<a {{ $attributes }} class="{{ $active ? 'text:white/50' : '' }} text-white hover:text-white/50"}}>
    {{$slot}}
</a>