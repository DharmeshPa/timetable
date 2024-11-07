<div class="grid grid-cols-12 gap-10">
     <x-form.field 
        name="start_time_at" 
        label="{{ __('forms.lbl_start_time') }}" 
        placeholder="{{ __('forms.lbl_start_time_placeholder') }}" 
        type="text"  
        field-classes="mb-5" 
        value="{{old('start_time_at',$content->start_time_at)}}"/>
    <x-form.field 
        name="end_time_at" 
        label="{{ __('forms.lbl_end_time') }}" 
        placeholder="{{ __('forms.lbl_end_time_placeholder') }}" 
        type="text"  
        field-classes="mb-5" 
        value="{{old('end_time_at',$content->end_time_at)}}" />
</div>

<div class="grid grid-cols-12 gap-10">
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
@php 
	$landsape_graphics = [];
    $portrait_graphics = [];

    foreach ($content->graphics as $key => $graphic){
		if($graphic->type === 'landscape'){
			$landsape_graphics[]=$graphic->path;
		}else{
            $portrait_graphics[]=$graphic->path;
        }
	}
    $landsape_graphics = json_encode(['landsape_graphics' => empty($landsape_graphics) ? array('') : $landsape_graphics ,'app_url'=>config('app.url')]);
    $portrait_graphics = json_encode(['portrait_graphics' => empty($portrait_graphics) ? array('') : $portrait_graphics ,'app_url'=>config('app.url')]);
@endphp
<div class="grid grid-cols-12 gap-10 mt-10">
    <div x-data='{{$landsape_graphics}}' class="col-span-6" x-sort>
        <template x-for="(landsape_graphic, index) in landsape_graphics" :key="index">
            <div class="flex mb-2 items-center" x-sort:item>

                <div x-sort:handle="" class="order relative before:content-['\f142'] before:font-['FontAwesome'] mr-2 before:width-[20px]"></div>

                <a :href="`${app_url}/${landsape_graphics[index]}`" class="w-[25px] mr-2" target="_blank">
                    <img :src="`${app_url}/${landsape_graphics[index]}`" class="rounded">
                </a>
                <input 
                    type="text" 
                    x-bind:value="landsape_graphics[index]" 
                    name="landsape_graphics[]" 
                    class="block w-100 flex-1 pointer-events-none ps-2 pe-2 rounded" 
                />
                <button 
                    type="button" 
                    x-on:click="landsape_graphics.splice(index, 1)" 
                    class="ml-2 bg-cypher-red hover:bg-cypher-red/50 trsansition-colors duration-300 shadow text-white rounded p-1 text-[14px] min-w-[86px]">
                    <i class="fa-solid fa-minus"></i>
                    {{ __('forms.btn_remove') }}
                </button>
            </div>
        </template>
    </div>
    <div x-data='{{$portrait_graphics}}' class="col-span-6" x-sort>
        <template x-for="(landsape_graphic, index) in portrait_graphics" :key="index">
            <div class="flex mb-2 items-center" x-sort:item>
                
                <div x-sort:handle="" class="order relative before:content-['\f142'] before:font-['FontAwesome'] mr-2 before:width-[20px]"></div>

                <a :href="`${app_url}/${portrait_graphics[index]}`" class="w-[25px] mr-2" target="_blank">
                    <img :src="`${app_url}/${portrait_graphics[index]}`" class="rounded">
                </a>
                <input 
                    type="text" 
                    x-bind:value="portrait_graphics[index]" 
                    name="portrait_graphics[]" 
                    class="block w-100 flex-1 pointer-events-none ps-2 pe-2 rounded" 
                />
                <button 
                    type="button" 
                    x-on:click="portrait_graphics.splice(index, 1)" 
                    class="ml-2 bg-cypher-red hover:bg-cypher-red/50 trsansition-colors duration-300 shadow text-white rounded p-1 text-[14px] min-w-[86px]">
                    <i class="fa-solid fa-minus"></i>
                    {{ __('forms.btn_remove') }}
                </button>
            </div>
        </template>
    </div>
</div>
