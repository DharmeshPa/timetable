<x-layout>
    @section('title', __('titles.venue'))
    <x-slot:title>{{__('titles.venue')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.add_new'),'venue') }}</x-slot:heading>
    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'venue') }}
        </x-form.submit>
    </x-slot:button>
    <x-form.form action="/venues/create" method="post" id="save">
        <x-form.field 
            name="name" 
            label="{{ __('forms.lbl_name') }}" 
            placeholder="{{__('forms.lbl_name_placeholder')}}"
            type="text"
            field-classes="mb-5" value="{{old('name')}}" />
        <x-form.field 
            name="description" 
            label="{{ __('forms.lbl_desc') }}"
            placeholder="{{__('forms.lbl_desc_placeholder')}}" 
            type="textarea"
            field-classes="mb-5">{{ old('description')}}</x-form.field>
        <!-- Repeat -->
        @php
            // Convert the array into a JSON-formatted string
            $defaults = json_encode(['fields' => ( old('locations') ? old('locations') : [''])]);
        @endphp
        <x-form.repeat icon_add="plus" icon_remove="minus" name="locations[]" placeholder="{{__('forms.lbl_location_placeholder')}}" :defaults="$defaults"></x-form.repeat>
    </x-form>
</x-layout>