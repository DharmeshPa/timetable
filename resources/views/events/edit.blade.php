<x-layout>

    @section('title', __('titles.event'))

    <x-slot:breadcrumb>
        You are here: <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a>
    </x-slot>
    
    <x-slot:title>{{__('titles.event')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.edit'), $event->name) }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'event') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/events/{{$event->id}}" method="put" id="save">
        
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_name_placeholder') }}" 
                type="text"  field-classes="mb-5" value="{{old('name',$event->name)}}"/>
            </div>
        <div class="grid grid-cols-5 gap-3">            
            
            <x-form.field 
                name="offset" 
                label="{{ __('forms.lbl_offset') }}" 
                placeholder="{{ __('forms.lbl_offset_placeholder') }}" 
                type="number"  field-classes="mb-5" value="{{old('offset',$event->offset)}}"/>

            <x-form.field 
                name="venue_id" 
                label="{{ __('forms.lbl_venue') }}" 
                data-placeholder="{{ __('forms.lbl_venue_placeholder') }}"
                type="select"
                :multiple="false"
                selected="{{ old('venue_id',$event->venue_id) }}"
                :options="\App\Models\Venue::all('id','name as title')"
                field-classes="mb-3"/>

            <x-form.field 
                name="theme_id" 
                label="{{ __('forms.lbl_theme') }}" 
                data-placeholder="{{ __('forms.lbl_theme_placeholder') }}"
                type="select"
                :multiple="false"
                selected="{{ old('theme_id',$event->theme_id) }}"
                :options="\App\Models\Theme::all('id','name as title')"
                field-classes="mb-3"/>
        </div>
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="description" 
                label="{{ __('forms.lbl_desc') }}"
                placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
                type="textarea" field-classes="mb-5">{{ old('description',$event->description) }}</x-form.field>
        </div>
    </x-form>
</x-layout>