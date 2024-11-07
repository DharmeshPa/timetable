@props(['width','align'])

@php 
	$class = ' text-'.$align.' font-400 px-3 py-4 border border-cypher-black/10';
@endphp

<td 
	{{ $attributes->merge(['class'=>$class])}} style="width:{{$width}}%">
	{{ $slot }}
</td>