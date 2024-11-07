<x-layout>

    @section('title', __('titles.content'))
    
    <x-slot:breadcrumb>
        You are here: 
         <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
         <a href="/displays/{{request()->route('content')->timetable->display->event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a> >
         <a href="/timetables/{{request()->route('content')->timetable->display->id}}" class="text-cypher-purple">{{__('titles.timetable')}}</a> >
         <a href="/contents/{{request()->route('content')->timetable->id}}" class="text-cypher-purple">{{__('titles.content')}}</a>
    </x-slot>

    <x-slot:title>{{__('titles.content')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.add_new'), 'content') }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'') }}
        </x-form.submit>
    </x-slot:button>

    @if ($content->type === 'topics')
    <x-form.form action="/topics/{{$content->id}}" method="put" id="save">
        @include('contents.topics.edit')
    </x-form>
    @endif

    @if ($content->type === 'message')
    <x-form.form action="/messages/{{$content->id}}" method="put" id="save">
        @include('contents.message.edit')
    </x-form>
    @endif
   
    @if ($content->type === 'graphic')
        <x-form.form 
            action="/graphics/{{$content->id}}" 
            method="put" 
            id="save" 
            enctype="multipart/form-data">
            @include('contents.graphics.edit')
        </x-form>
    @endif

</x-layout>