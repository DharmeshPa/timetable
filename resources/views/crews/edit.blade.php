<x-layout>
    @section('title', __('titles.crew'))
    
    <x-slot:title>{{__('titles.crew')}}</x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.edit'),'crew') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'venue') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/crews/{{$crew->id}}" method="put" id="save">
    
        <div class="grid grid-cols-3 gap-3">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{__('forms.lbl_name_placeholder') }}"
                type="text" 
                field-classes="mb-3 w-50"
                value="{{ old('name', $crew->name) }}"/>
            <x-form.field 
                name="email" 
                label="{{ __('forms.lbl_email') }}" 
                placeholder="{{__('forms.lbl_email_placeholder') }}"
                type="email" 
                field-classes="mb-3"
                value="{{ old('email', $crew->email) }}"/>
            <x-form.field 
                name="phone" 
                label="{{ __('forms.lbl_phone') }}" 
                placeholder="{{__('forms.lbl_phone_placeholder') }}"
                type="text" 
                field-classes="mb-3"
                value="{{ old('phone', $crew->phone) }}"/>
        </div>

        <x-form.field 
            name="roles[]" 
            label="{{ __('forms.lbl_roles') }}" 
            data-placeholder="{{ __('forms.lbl_role_placeholder') }}"
            type="select"
            :multiple="true"
            selected="{{ (old('roles') && is_array(old('roles')) ? Arr::join(old('roles'), ',') : Arr::join($crew->roles->pluck('id')->all(), ','))}}"
            :options="$roles"
            field-classes="mb-3" />
        <x-form.field 
            name="description" 
            label="{{ __('forms.lbl_desc') }}"
            placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
            type="textarea" 
            field-classes="mb-3">{{ old('description') || $crew->description ? old('description',$crew->description) : '' }}</x-form.form>
    </x-form>
</x-layout>