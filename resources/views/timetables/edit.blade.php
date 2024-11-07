<x-layout>

    @section('title', __('titles.timetable'))

    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{request()->route('timetable')->display->event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a> >
        <a href="/timetables/{{request()->route('timetable')->display->id}}" class="text-cypher-purple">{{__('titles.timetable')}}</a>
    </x-slot>
    

    <x-slot:title>{{__('titles.timetable')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.edit'), $timetable->name) }}</x-slot:heading>

    <x-slot:button>
        <x-form.submit class="" form="save" icon="floppy-disk">
            {{ sprintf(__('forms.btn_save'),'timetable') }}
        </x-form.submit>
    </x-slot:button>
    <x-form.form action="/timetables/{{$timetable->id}}" method="put" id="save">
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="name" 
                label="{{ __('forms.lbl_name') }}" 
                placeholder="{{ __('forms.lbl_timetable_placeholder') }}" 
                type="text"  
                field-classes="mb-5" 
                value="{{old('name',$timetable->name)}}"/>
        </div>
        <div class="grid grid-cols-5 gap-3">            
            <x-form.field 
                name="start_at" 
                label="{{ __('forms.lbl_start_date') }}" 
                placeholder="{{ __('forms.lbl_start_date_placeholder') }}" 
                type="date"  
                field-classes="mb-5" 
                value="{{old('start_at',date('Y-m-d',strtotime($timetable->start_at)))}}"/>
            
            <x-form.field 
                name="end_at" 
                label="{{ __('forms.lbl_end_date') }}" 
                placeholder="{{ __('forms.lbl_end_date_placeholder') }}" 
                type="date"  
                field-classes="mb-5" 
                value="{{old('end_at',date('Y-m-d',strtotime($timetable->end_at)))}}" />

            <x-form.field 
                name="start_time_at" 
                label="{{ __('forms.lbl_start_time') }}" 
                placeholder="{{ __('forms.lbl_start_time_placeholder') }}" 
                type="text"  
                field-classes="mb-5" 
                value="{{old('start_time_at',$timetable->start_time_at)}}"/>

            <x-form.field 
                name="end_time_at" 
                label="{{ __('forms.lbl_end_time') }}" 
                placeholder="{{ __('forms.lbl_end_time_placeholder') }}" 
                type="text"  
                field-classes="mb-5" 
                value="{{old('end_time_at',$timetable->end_time_at)}}" />
            <x-form.field 
                name="item_expire_time" 
                label="{{ __('forms.lbl_session_expiration_time') }}" 
                placeholder="{{ __('forms.lbl_session_expiration_time_placeholder') }}" 
                type="number"  
                field-classes="mb-5" 
                value="{{old('item_expire_time',$timetable->item_expire_time)}}"/>
        </div>
        <div class="grid grid-cols-1 gap-0">
            <x-form.field 
                name="description" 
                label="{{ __('forms.lbl_desc') }}"
                placeholder="{{ __('forms.lbl_desc_placeholder') }}" 
                type="textarea" 
                field-classes="mb-5">{{ old('description',$timetable->description) }}</x-form.field>
        </div>
    </x-form>
</x-layout>