<x-layout>
    @section('title', __('titles.location'))
    <x-slot:title>{{__('titles.location')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Locations') }}</x-slot:heading>
    <x-slot:button>
        <x-form.button href="/locations/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'location') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="20" align="center" col="">{{__('table.number') }} {{__('table.of') }} {{__('table.crews') }}</x-table.th>
                <x-table.th width="30" align="left" col="">{{ __('table.venue')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.created_at')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.updated_at')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($locations as $location)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/locations/{{$location->id}}/edit" icon="square-pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/locations/{{$location->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>

                <x-table.td width="20" align="left">
                   {{ $location->name }}
                </x-table.td>
                <x-table.td width="20" align="center">
                    <x-link :sidebar="false" href="/locations/{{$location->id}}/edit" icon="" class="justify-center text-cypher-purple">
                        {{ count($location->crews)}}
                    </x-link>
                </x-table.td>
                <x-table.td width="30" align="left">
                    <x-link :sidebar="false" href="/venues/{{$location->venue->id}}/edit" icon="" class="text-cypher-purple">
                        {{ $location->venue->name }}
                    </x-link>
                </x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($location->created_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($location->updated_at)->format('d-m-Y') }}</x-table.td>
               
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $locations->links() }}</div>
</x-layout>