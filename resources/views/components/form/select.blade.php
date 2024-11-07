@props(['name','options','placehoder','defaults'])
@php
$selected = (is_array($attributes->get('selected')) ? $attributes->get('selected') : explode(",",$attributes->get('selected')));
@endphp

<select class="chosen-select bg-white" name="{{$name}}" {{$attributes->merge(['class'=>''])}}>
    <option value=""></option>
    @foreach ($options as $option)
	    <option value="{{$option->id}}" {{ (in_array($option->id,$selected)) ? "selected" : "" }}>{{$option->title}}</option>
   	@endforeach
</select>