<x-layout>

    @section('title', __('titles.display'))
    
    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{$display->event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a>
    </x-slot>

    <x-slot:title>{{__('titles.display')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.edit'), $display->name) }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'display') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/displays/{{$display->id}}" method="put" id="save">
        
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_display_placeholder') }}" 
                type="text"  field-classes="mb-5" value="{{old('name',$display->name)}}"/>
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="description" 
                label="{{ __('forms.lbl_desc') }}"
                placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
                type="textarea" field-classes="mb-5">{{ old('description',$display->description) }}</x-form.field>
        </div>
    </x-form>
</x-layout>