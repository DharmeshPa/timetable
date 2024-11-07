<x-layout>
    @section('title', __('titles.display'))
    <x-slot:breadcrumb>
        You are here: <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > Displays
    </x-slot>
    <x-slot:title>{{__('titles.display')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Displays') }}</x-slot:heading>
    <x-slot:button>
        <x-form.button href="/displays/create/{{$event->id}}" icon="plus" :outline="false">
            {{ sprintf(__('forms.btn_new'),'display') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="40" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="50" align="left" col="">{{__('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($displays as $display)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">                
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/displays/{{$display->id}}/edit" icon="pen" class="text-cypher-black/80"></x-link>
                        <x-link :sidebar="false" href="/timetables/{{$display->id}}" icon="calendar-days" class="text-cypher-green"></x-link>
                        <x-link :sidebar="false" target="_blank" href="/{{$display->id}}/" icon="up-right-from-square" class="text-cypher-purple"></x-link>
                        <x-link :sidebar="false" href="/displays/{{$display->id}}/duplicate" icon="copy" class="text-cypher-black"></x-link>
                        <x-link :sidebar="false" href="/displays/{{$display->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="40" align="left">{{ $display->name }}</x-table.td>
                <x-table.td width="50" align="left">{{ \Illuminate\Support\Str::limit($display->description,20) }}</x-table.td>
                
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $displays->links() }}</div>
</x-layout>



