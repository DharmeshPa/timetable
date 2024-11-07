<x-layout>

    @section('title', __('titles.display'))
    
    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{$event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a>
    </x-slot>
    
    <x-slot:title>{{__('titles.display')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.add_new'), 'display') }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'display') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/displays/create/{{$event->id}}" method="post" id="save">
        
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_display_placeholder') }}" 
                type="text"  field-classes="mb-5" value="{{old('name')}}"/>
            <x-form.field 
                name="description" 
                label="{{ __('forms.lbl_desc') }}"
                placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
                type="textarea" field-classes="mb-5">{{ old('description') }}</x-form.field>
        </div>
    </x-form>
</x-layout>