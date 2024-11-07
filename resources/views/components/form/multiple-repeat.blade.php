<!-- Repeat -->
@php
 // Use the `map` function to transform the crews collection
$crews = $location->crews->map(function ($crew) {
    return [
        'title' => $crew->title,
        'first_name' => $crew->first_name,
        'last_name' => $crew->last_name,
    ];
})->toArray();
@endphp
@php
    // Convert the array into a JSON-formatted string
    $fields = json_encode(['fields' => $crews]);
@endphp
<!-- Repeat -->
<div x-data="{{$fields}}">
    <!-- Add Input Button at the Top -->
    <div class="flex justify-end">
        <button 
            type="button" 
            x-on:click="fields.push('')" 
            class="bg-cypher-green hover:bg-cypher-green/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] mb-5 min-w-[86px]">
            <i class="fa-solid fa-plus"></i>
            {{ __('forms.btn_add') }}
        </button>
    </div>
    <!-- Dynamic Input Fields -->
    <div>
        <template x-for="(field, index) in fields" :key="index">
            <div class="mb-3 flex">
                <x-form.field 
                    type="text" 
                    x-model="field.title" 
                    name="titles[]" 
                    label="" 
                    placeholder="{{ __('forms.lbl_title')}}..." 
                    field-classes="flex-1"/>
                <x-form.field 
                    type="text" 
                    x-model="field.first_name" 
                    name="first_names[]" 
                    label="" 
                    placeholder="{{ __('forms.lbl_first_name')}}..." 
                    field-classes="flex-1"/>
                <x-form.field 
                    type="text" 
                    x-model="field.last_name" 
                    name="last_names[]" 
                    label="" 
                    placeholder="{{ __('forms.lbl_last_name')}}..."  
                    field-classes="flex-1"/>
                <button 
                    type="button" 
                    x-on:click="fields.splice(index, 1)" 
                    class="ml-2 bg-cypher-red hover:bg-cypher-red/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] min-w-[86px]">
                    <i class="fa-solid fa-minus"></i>
                    {{ __('forms.btn_remove') }}
            </div>
        </template>
    </div>
</div>