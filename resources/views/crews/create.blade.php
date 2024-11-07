<x-layout>
    @section('title', __('titles.crew'))
    
    <x-slot:title>{{__('titles.crew')}}</x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.add_new'),'crew') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'venue') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/crews/create" method="post" id="save">
        
        <div class="grid grid-cols-3 gap-3">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{__('forms.lbl_name_placeholder') }}"
                type="text" 
                field-classes="mb-5"
                value="{{ old('name') }}"/>
            <x-form.field 
                name="email" 
                label="{{ __('forms.lbl_email') }}" 
                placeholder="{{__('forms.lbl_email_placeholder') }}"
                type="email" 
                field-classes="mb-5"
                value="{{ old('email') }}"/>

            <x-form.field 
                name="phone" 
                label="{{ __('forms.lbl_phone') }}" 
                placeholder="{{__('forms.lbl_phone_placeholder') }}"
                type="text" 
                field-classes="mb-5"
                value="{{ old('phone') }}"/>
        </div>
        <div class="grid grid-cols-1">
            <x-form.field 
                name="roles[]" 
                label="{{ __('forms.lbl_roles') }}" 
                data-placeholder="{{ __('forms.lbl_role_placeholder') }}"
                type="select"
                :multiple="true"
                selected="{{ (is_array(old('roles')) ? Arr::join(old('roles'), ',') : old('roles'))}}"
                :options="$roles"
                field-classes="mb-5" />
            <x-form.field 
                name="description" 
                label="{{ __('forms.lbl_desc') }}"
                placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
                type="textarea" 
                field-classes="mb-5">{{ old('description') ? old('description') : '' }}</x-form.form>
        </div>
    </x-form>
</x-layout>