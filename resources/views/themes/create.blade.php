<x-layout>
    @section('title', __('titles.theme'))
    
    <x-slot:title>{{__('titles.theme')}}</x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.add_new'),'theme') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'role') }}
        </x-form.submit>
    </x-slot:button>

    <x-form.form action="/themes/create" method="post" id="save" enctype="multipart/form-data">
        
         <div class="grid grid-cols-12 gap-0">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_theme_name_placeholder') }}" 
                type="text"
                value="{{old('name')}}"
                field-classes="mb-5 col-span-3" />
        </div>

        <div class="grid grid-cols-12 gap-0">
            <x-form.field 
                name="bg_image" 
                label="{{ __('forms.lbl_event_bg') }}" 
                placeholder="{{ __('forms.lbl_event_bg_placeholder') }}" 
                type="file"
                accept="image/*"
                field-classes="mb-5 col-span-3" />
        </div>

        
        

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <div>{{__('forms.lbl_graphics')}}</div>
                
                <x-form.field 
                    name="slider_duration" 
                    label="" 
                    placeholder="{{ __('forms.lbl_slider_duration_placeholder') }}" 
                    type="text"
                    value="{{old('slider_duration','500')}}"
                    field-classes="mb-2 mt-3" />
                <x-form.field 
                    name="slider_pause" 
                    label="" 
                    placeholder="{{ __('forms.lbl_slider_pause_placeholder') }}" 
                    type="text"
                    value="{{old('slider_pause','8000')}}"
                    field-classes="mb-2" />
                @php 
                    $options[] = (object) ['id' => 'ease', 'title'=>'Ease'];
                    $options[] = (object) ['id' => 'linear', 'title'=>'Linear'];
                    $options[] = (object) ['id' => 'ease-in', 'title'=>'Ease-in'];
                    $options[] = (object) ['id' => 'ease-out', 'title'=>'Ease-out'];
                    $options[] = (object) ['id' => 'ease-in-out', 'title'=>'Ease-in-out'];
                @endphp
                <x-form.field 
                    name="slider_easing" 
                    label="" 
                    data-placeholder="{{ __('forms.lbl_slider_easing_placeholder') }}"
                    type="select"
                    :multiple="false"
                    selected="{{old('slider_easing','ease')}}"
                    :options="$options"
                    field-classes="mb-2"/>  
                @php
                    $options = array(); 
                    $options[] = (object) ['id'=>'horizontal','title'=>'Horizontal'];
                    $options[] = (object) ['id'=>'vertical','title'=>'Vertical'];
                    $options[] = (object) ['id'=>'fade','title'=>'Fade'];
                @endphp
                <x-form.field 
                    name="slider_effect" 
                    label="" 
                    data-placeholder="{{ __('forms.lbl_slider_effect_placeholder') }}"
                    type="select"
                    :multiple="false"
                    selected="{{old('slider_effect','fade')}}"
                    :options="$options"
                    field-classes="mb-2"/>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-0 mt-5">

            <div class="col-span-12">
                
                <div>{{__('forms.lbl_custom_css')}}</div>

                <x-form.field 
                    name="custom_css" 
                    label=""
                    placeholder="" 
                    type="textarea" rows="20" field-classes="mb-5">{{ old('custom_css', '/*Custom CSS...*/') }}</x-form.field>
            </div>

        </div>
    </x-form>
</x-layout>
