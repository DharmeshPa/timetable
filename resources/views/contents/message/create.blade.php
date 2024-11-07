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

<div class="grid grid-cols-12 gap-0">
     <x-form.field 
        name="message" 
        label="{{ __('forms.lbl_message') }}" 
        placeholder="{{ __('forms.lbl_message_placeholder') }}" 
        type="textarea"
        field-classes="mb-5" id="editor">{{old('message')}}</x-form.field>
</div>