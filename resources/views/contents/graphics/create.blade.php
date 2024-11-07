<div class="grid grid-cols-12 gap-3">
     <x-form.field 
        name="start_time_at" 
        label="{{ __('forms.lbl_start_time') }}" 
        placeholder="{{ __('forms.lbl_start_time_placeholder') }}" 
        type="text"  
        field-classes="mb-5" 
        value="{{old('start_time_at')}}"/>
    <x-form.field 
        name="end_time_at" 
        label="{{ __('forms.lbl_end_time') }}" 
        placeholder="{{ __('forms.lbl_end_time_placeholder') }}" 
        type="text"  
        field-classes="mb-5" 
        value="{{old('end_time_at')}}" />
</div>

<div class="grid grid-cols-12 gap-3">
    <x-form.field 
        name="landscape[]" 
        label="{{ __('forms.lbl_file_landscape') }}" 
        placeholder="{{ __('forms.lbl_file_landscape_placeholder') }}" 
        type="file"
        accept="image/*" 
        multiple
        field-classes="mb-5 col-span-6" />

      <x-form.field 
        name="portrait[]" 
        label="{{ __('forms.lbl_file_portrait') }}" 
        placeholder="{{ __('forms.lbl_file_portrait_placeholder') }}" 
        type="file"
        accept="image/*" 
        multiple 
        field-classes="mb-5 col-span-6" />

</div>