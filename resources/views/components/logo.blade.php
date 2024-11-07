@props(['logo','type'])

@if($type === "text")
<div {{ $attributes->merge(['class'=>'text-white'])}}>{{ $logo }}</div>
@endif

@if($type === "image")
<img {{ $attributes->merge(['class'=>''])}} src="{{asset($logo)}}"/>
@endif