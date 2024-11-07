@props(['icon','sidebar'=> true])

@php

$hover_classes = 'transition-colors duration-200 ' . ($sidebar ? 'hover:bg-cypher-gray/50' : 'hover:text-cypher-purple/80');
$base_classes = ($sidebar ? 'shadow py-3 px-5 flex flex-col' : 'flex flex-row items-center') .' '.$hover_classes;
$classes = $attributes->merge(['class'=> $base_classes ]);

@endphp

@if ($icon === 'trash')
	<form action="{{$attributes->get('href')}}" method="post">
		@csrf
		@method('DELETE')
		<button type="submit" name="submit" class="group" onclick="if(confirm('Are you sure you want to delete this? All associated data will be deleted.')){return true}else{return false}">
			<i class="fa-solid fa-{{$icon}} {{$attributes->get('class')}} text-[16px] group-hover:text-cypher-red/50 transition-colors duration-200"></i>
		</button>
	</form>
@else
	@if ($sidebar)
	<a {{ $classes }} {{$attributes->get('target')}}>
		<i class="fa-solid fa-{{$icon}} text-white text-[23px]"></i>
		<span class="text-[16px]">{{ $slot }}</span>
	</a>
	@else
	<a {{ $classes }} {{$attributes->get('target')}}>
		@if($icon)
		<i class="fa-solid fa-{{$icon}}"></i>
		@endif
		<span class="text-[16px]">{{ $slot }}</span>
	</a>
	@endif
@endif