<x-layout>
    @section('title', __('titles.role'))
    
    <x-slot:title>{{__('titles.role')}}</x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.add_new'),'role') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'role') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/roles/create" method="post" id="save">
        <x-form.field 
            name="title" 
            label="{{ __('forms.lbl_title') }}" 
            placeholder="{{__('forms.lbl_title_placeholder') }}"
            type="text" 
            field-classes="mb-5"
            value="{{ old('title') }}"/>
        <x-form.field
            name="description" 
            label="{{ __('forms.lbl_desc') }}"
            placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
            type="textarea"
            field-classes="mb-5">{{ old('description') }}</x-form.field>
    </x-form>
</x-layout>