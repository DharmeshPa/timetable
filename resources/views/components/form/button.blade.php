@props(['icon','outline'])

@php
$class = 'group rounded px-5 py-2 font-bold transition-colors duration-400';
@endphp
@if ($outline)
    @php
    $class .= ' text-cypher-purple bg-white border border-cypher-purple hover:bg-cypher-purple hover:text-white';
    $iconClass = 'text-cypher-purple group-hover:text-white';
    @endphp
@else
    @php
    $class .= ' text-white bg-cypher-purple border border-cypher-purple hover:bg-white hover:text-cypher-purple';
    $iconClass = 'text-white group-hover:text-cypher-purple';
    @endphp
@endif

<a {{ $attributes->merge(['class'=>$class])}}>
	<i class="fa-solid fa-{{$icon}} text-[16px] {{$iconClass}}"></i>
	{{ $slot }}
</a>

