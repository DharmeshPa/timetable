<x-layout>

    @section('title', __('titles.content'))
    
    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{request()->route('timetable')->display->event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a> >
        <a href="/timetables/{{request()->route('timetable')->display->id}}" class="text-cypher-purple">{{__('titles.timetable')}}</a> >
        <a href="/contents/{{request()->route('timetable')->id}}" class="text-cypher-purple">{{__('titles.content')}}</a>
    </x-slot>

    <x-slot:title>{{__('titles.content')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.add_new'), 'content') }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'display') }}
        </x-form.submit>
    </x-slot:button>

    @if ($type === 'topics')
        <x-form.form action="/topics/create/{{$timetable->id}}/{{$type}}" method="post" id="save">
            @include('contents.topics.create')
        </x-form>
    @endif

    @if ($type === 'message')
        <x-form.form action="/messages/create/{{$timetable->id}}/{{$type}}" method="post" id="save">
         @include('contents.message.create')
        </x-form>
    @endif

    @if ($type === 'graphics')
        <x-form.form 
            action="/graphics/create/{{$timetable->id}}/{{$type}}" 
            method="post" 
            id="save" 
            enctype="multipart/form-data">
            @include('contents.graphics.create')
        </x-form>
    @endif

</x-layout>