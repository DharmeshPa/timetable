@props(['defaults'])

<div x-data="{{$defaults}}" class="mt-10">
    <!-- Add Input Button at the Top -->
    <div class="flex justify-between items-center">
        <h1 class="font-medium text-cypher-black/80">{{ $attributes->get('section') }}</h1>
        <button 
            type="button" 
            x-on:click="fields.push('')" 
            class="bg-cypher-green hover:bg-cypher-green/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] min-w-[86px]">
            <i class="fa-solid fa-{{$attributes->get('icon_add')}}"></i>
            {{ __('forms.btn_add') }}
        </button>
    </div>
    <!-- Dynamic Input Fields -->
    <div class="flex flex-col mt-5">
        <template x-for="(input, index) in fields" :key="index">
            <div class="flex items-center space-x-2 mb-2">
                <input 
                    type="text" 
                    x-model="fields[index]" 
                    name="{{$attributes->get('name')}}" 
                    class="border p-2 rounded w-[95%] focus:outline-none focus:cursor-auto focus:ring-2 focus:ring-inset focus:ring-cypher-purple/50" 
                    placeholder="{{$attributes->get('placeholder')}}"
                />
                <button 
                    type="button" 
                    x-on:click="fields.splice(index, 1)" 
                    class="bg-cypher-red hover:bg-cypher-red/50 trsansition-colors duration-300 shadow text-white rounded p-2 text-[14px] min-w-[86px]">
                    <i class="fa-solid fa-{{$attributes->get('icon_remove')}}"></i>
                    {{ __('forms.btn_remove') }}
                </button>
            </div>
        </template>
    </div>
</div>