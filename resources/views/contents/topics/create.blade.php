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

    <x-form.field 
        name="group_title" 
        label="{{ __('forms.lbl_group') }}" 
        placeholder="{{ __('forms.lbl_group_placeholder') }}" 
        type="text"  
        field-classes="mb-5 col-span-3" 
        value="{{old('group_title')}}"/>

    <x-form.field 
        name="visibility" 
        label="{{ __('forms.lbl_hidden') }}" 
        placeholder="" 
        type="checkbox"
        field-classes="mb-5 text-left"
        :inline="false" :checked="( old('visibility') ? true : false)"/>
    <x-form.field 
        name="group_title_bold" 
        label="{{ __('forms.lbl_group_bold') }}" 
        placeholder="" 
        type="checkbox"  
        field-classes="mb-5 text-left col-span-2"
        :inline="false" :checked="(old('group_title_bold') ? true : false)"/>

    <x-form.field 
        name="group_title_italic" 
        label="{{ __('forms.lbl_group_italic') }}" 
        placeholder="" 
        type="checkbox"  
        field-classes="mb-5 text-left  col-span-2"
        :inline="false" :checked="(old('group_title_italic') ? true : false)"/>
    <x-form.field 
        name="hide_session_end_time" 
        label="{{ __('forms.lbl_hidden_session_end_time') }}" 
        placeholder="" 
        type="checkbox"  
        field-classes="mb-5 col-span-2"
        :inline="false" :checked="(old('hide_session_end_time') ? true : false)"/>
</div>


<div class="grid grid-cols-1 gap-0">
@php
    $topics = array();
    if (old('names')) {
        foreach (old('names') as $key => $name) {
            $topics[] = array(
                'name' => old('names')[$key],
                'bold' => (old('bold')[$key] ? true : false),
                'italic' => (old('italic')[$key] ? true : false),
                'location' => old('locations')[$key],
                'description' => old('descriptions')[$key],
                'requirement' => old('requirements')[$key],
            );
        }
    }
    $topics = json_encode(['topics' => empty($topics) ? array('') : $topics ]);
@endphp
    
    <!-- Repeat -->
    <div x-data="{{$topics}}" class="mt-10 bg-white p-10">
        <!-- Add Input Button at the Top -->
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-5">{{ __('forms.lbl_title')}}</div>
            <div>{{ __('forms.lbl_bold') }}</div>
            <div>{{ __('forms.lbl_italic') }}</div>
            <div class="col-span-2">{{ __('forms.lbl_location') }}</div>
            <div class="col-span-2">{{ __('forms.lbl_desc') }}</div>
            <button 
                type="button" 
                x-on:click="topics.push({ name: '', bold: false, italic: false, location: '',description:'',requirement:''})" 
                class="bg-cypher-green hover:bg-cypher-green/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] mb-5 max-w-[86px] ml-2">
                <i class="fa-solid fa-plus"></i>
                {{ __('forms.btn_add') }}
            </button>
        </div>
        <!-- Dynamic Input topics -->
        <div>
            <template x-for="(topic, index) in topics" :key="index">
                <div class="mb-5 grid grid-cols-12 gap-3 items-center">
                    <input type="hidden" x-bind:name="`bold[${index}]`"/>
                    <input type="hidden" x-bind:name="`italic[${index}]`"/>
                    <x-form.field 
                        type="text" 
                        x-model="topic.name" 
                        name="names[]" 
                        label="" 
                        placeholder="{{ __('forms.lbl_title')}}..." 
                        field-classes="col-span-5"/>

                    <x-form.field 
                        x-bind:name="`bold[${index}]`" 
                        x-model="topic.bold" 
                        label=""
                        placeholder="" 
                        type="checkbox"  
                        field-classes="text-left"
                        :inline="false"/>
                    <x-form.field 
                        x-bind:name="`italic[${index}]`"  
                        x-model="topic.italic" 
                        label="" 
                        placeholder="" 
                        type="checkbox"  
                        field-classes="text-left"
                        :inline="false"/>
                    <x-form.field 
                        x-ref="select"
                        name="locations[]" 
                        x-model="topic.location"
                        label="" 
                        data-placeholder="{{ __('forms.lbl_location_placeholder') }}"
                        type="select"
                        x-init="initChosen($refs.select)"
                        x-on:change="initChosen($refs.select)" 
                        :multiple="false"
                        x-bind:value="topic.location"
                        :options="$locations"
                        field-classes="col-span-2"/>
                    
                    <x-form.field 
                        type="text" 
                        x-model="topic.description" 
                        name="descriptions[]" 
                        label="" 
                        placeholder="{{ __('forms.lbl_desc_placeholder')}}..." 
                        field-classes="col-span-2"/>
                    <button 
                        type="button" 
                        x-on:click="topics.splice(index, 1)" 
                        class="ml-2 bg-cypher-red hover:bg-cypher-red/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] max-w-[86px] h-[40px] mt-[5px]">
                        <i class="fa-solid fa-minus"></i>
                        {{ __('forms.btn_remove') }}
                    </button>
                    <x-form.field 
                        type="text" 
                        x-model="topic.requirement" 
                        name="requirements[]" 
                        label="" 
                        placeholder="{{ __('forms.lbl_requirement_placeholder')}}..." 
                        field-classes="col-span-12"/>
                </div>
            </template>
        </div>
    </div>
</div>
<script>
    function initChosen(select) {
        $(select).chosen({
            width:'100%',
            no_results_text: "{{ __('forms.no_results') }}",
            placeholder_text_single: "{{ __('forms.lbl_location_placeholder') }}"
        }).trigger("chosen:updated");
    }
</script>