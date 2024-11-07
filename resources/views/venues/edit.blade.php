<x-layout>

    @section('title', __('titles.venue'))
    
    <x-slot:title>{{__('titles.venue')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.edit'),$venue->name) }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'venue') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/venues/{{$venue->id}}" method="put" id="save" >
        
        <x-form.field 
            name="name" 
            label="{{ __('forms.lbl_name') }}" 
            placeholder="{{ __('forms.lbl_name_placeholder') }}" 
            type="text"
            field-classes="mb-5"
            value="{{ old('name',$venue->name)}}" />
        <x-form.field
            name="description" 
            label="{{ __('forms.lbl_desc') }}"
            placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
            type="textarea"
            field-classes="mb-5">{{ old('description',$venue->description)}}</x-form.field>
        <!-- Repeat -->
        @php
            // Convert the array into a JSON-formatted string
            $defaults = json_encode(['fields' => ( old('locations') ? old('locations') : $locations )]);
        @endphp
        <!-- Repeat -->
        <x-form.repeat section="Add/Remove locations" icon_add="plus" icon_remove="minus" name="locations[]" placeholder="enter location..." :defaults="$defaults"></x-form.repeat>
    </x-form>
</x-layout>