<x-layout>
    @section('title', __('titles.event'))

    <x-slot:breadcrumb>
        You are here: <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a>
    </x-slot>

    <x-slot:title>
        {{__('titles.event')}}
    </x-slot:title>
    
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Events') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.button href="/events/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'event') }}
        </x-form.button>
    </x-slot:button>
    
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col="">&nbsp;</x-table.th>
                <x-table.th width="30" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="30" align="left" col="">{{ __('table.venue')}}</x-table.th>
                <x-table.th width="10" align="left" col="">{{ __('table.theme')}}</x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($events as $event)
            <x-table.tr>
                <x-table.td width="2" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/events/{{$event->id}}/edit" icon="pen" class="text-cypher-black/80"></x-link>
                        <x-link :sidebar="false" href="/displays/{{$event->id}}" icon="tv" class="text-cypher-green"></x-link>
                        <x-link :sidebar="false" href="/events/{{$event->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="30" align="left">
                    {{ $event->name }}
                </x-table.td>
                <x-table.td width="30" align="left">
                    <x-link :sidebar="false" href="/venues/{{$event->venue->id}}/edit" icon="" class="text-cypher-purple">
                        {{ $event->venue->name }}
                    </x-link>
                </x-table.td>
                <x-table.td width="10" align="left">
                    <x-link :sidebar="false" href="/themes/{{$event->theme->id}}/edit" icon="" class="text-cypher-purple">
                        {{ $event->theme->name }}
                    </x-link>
                </x-table.td>
                <x-table.td width="20" align="left">{{ \Illuminate\Support\Str::limit($event->description,20) }}</x-table.td>
               
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $events->links() }}</div>
</x-layout>