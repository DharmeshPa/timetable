<x-layout>
    @section('title', __('titles.timetable'))

    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{request()->route('display')->event_id}}" class="text-cypher-purple">{{__('titles.display')}}</a> >
        {{__('titles.timetable')}}
    </x-slot>

    <x-slot:title>{{__('titles.timetable')}}</x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Timetables') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.button href="/timetables/create/{{$display->id}}" icon="plus" :outline="false">
            {{ sprintf(__('forms.btn_new'),'timetable') }}
        </x-form.button>
    </x-slot:button>
    
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="10" align="left" col="">{{ __('table.start_time')}}</x-table.th>
                <x-table.th width="10" align="left" col="">{{ __('table.end_at')}}</x-table.th>
                <x-table.th width="50" align="left" col="">{{__('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($timetables as $timetable)
            <x-table.tr>
                 <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/timetables/{{$timetable->id}}/edit" icon="pen" class="text-cypher-black/80"></x-link>
                        <x-link :sidebar="false" href="/contents/{{$timetable->id}}" icon="list-check" class="text-cypher-green"></x-link>
                        <x-link :sidebar="false" target="_blank" href="/preview/{{$timetable->id}}" icon="eye" class="text-cypher-purple"></x-link>
                        <x-link :sidebar="false" href="/timetables/{{$timetable->id}}/duplicate" icon="copy" class="text-cypher-black"></x-link>
                        <x-link :sidebar="false" href="/timetables/{{$timetable->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="20" align="left">
                     {{ $timetable->name }}
                </x-table.td>
                
                <x-table.td width="10" align="left">
                    {{ \Carbon\Carbon::parse($timetable->start_at)->format('d-m-Y') }} 
                    {{ $timetable->start_time_at }}</x-table.td>
                <x-table.td width="10" align="left">
                    {{ \Carbon\Carbon::parse($timetable->end_at)->format('d-m-Y') }} 
                    {{ $timetable->end_time_at }}</x-table.td>
                <x-table.td width="50" align="left">
                    {{ \Illuminate\Support\Str::limit($timetable->description,20) }}
                </x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $timetables->links() }}</div>
</x-layout>