@props(['label','type','options'])

@php 

$name = $attributes->get('name');

@endphp


<div class="{{ request()->is('login') ? 'text-center ' : '' }} {{ $attributes->get('field-classes') ? $attributes->get('field-classes') : '' }}">  
    @if(in_array($type,['email','text','password','number','date','time']))
        <x-form.label {{$attributes->except(['field-classes'])}} for="{{ $name }}">{{$label}}</x-label>
        <x-form.input {{$attributes->except(['field-classes'])}} id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" />
    @endif


    @if(in_array($type,['file']))
        <x-form.label {{$attributes->except(['field-classes','multiple','accept','placeholder'])}} for="{{ $name }}">{{$label}}</x-label>
        <x-form.file {{$attributes->except(['field-classes'])}} id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" />
    @endif


    @if(in_array($type,['checkbox','radio']))
        <x-form.checkbox {{$attributes->except(['field-classes'])}} label="{{$label}}" name="{{$name}}"/>
    @endif

    @if(in_array($type,['select']))
        <x-form.label for="{{ $name }}">{{$label}}</x-label>
        <x-form.select {{$attributes->except(['field-classes'])}} label="{{$label}}" name="{{$name}}" :options="$options" />
    @endif

    @if(in_array($type,['textarea']))
        <x-form.label {{$attributes->except(['field-classes','id'])}} for="{{ $name }}">{{$label}}</x-label>
        <x-form.textarea {{$attributes->except(['field-classes'])}} label="{{$label}}" name="{{$name}}">{{$slot}}</x-form.textarea>
    @endif
</div>