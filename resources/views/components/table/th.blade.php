@props(['width','align','col'])

@php 
	$class = ' text-'.$align.' font-400 px-3 py-3 hover:cursor-pointer bg-cypher-black/10 border border-cypher-black/10';
@endphp


@if($col != "")
	<th 
		{{ $attributes->merge(['class'=> 'sort ' .$class])}} style="width:{{$width}}%">
		{{ $slot }}
	</th>
@else
	<th 
		{{ $attributes->merge(['class'=>$class])}} style="width:{{$width}}%">
		{{ $slot }}
	</th>
@endif

