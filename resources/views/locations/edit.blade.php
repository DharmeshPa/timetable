<x-layout>

    @section('title', __('titles.location'))
    
    <x-slot:title>{{__('titles.location')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.edit'),$location->name) }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'location') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/locations/{{$location->id}}" method="put" id="save">
        <div class="grid grid-cols-2 gap-3">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_location_placeholder') }}" 
                type="text" field-classes="mb-5" value="{{old('name',$location->name)}}"/>

            <x-form.field 
                name="venue_id" 
                label="{{ __('forms.lbl_venue') }}" 
                data-placeholder="{{ __('forms.lbl_venue_placeholder') }}"
                type="select"
                :multiple="false"
                selected="{{old('venue_id',$location->venue_id)}}"
                :options="$venues"
                field-classes="mb-3"/>
        </div>      
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="crews[]" 
                label="{{ __('forms.lbl_crews') }}" 
                data-placeholder="{{ __('forms.lbl_crews_placeholder') }}"
                type="select"
                :multiple="true"
                selected="{{ (old('crews') && is_array(old('crews')) ? Arr::join(old('crews'), ',') : Arr::join($location->crews->pluck('id')->all(), ','))}}"
                :options="$crews"
                field-classes="mb-3"/>
        </div>
    </x-form>
</x-layout>