<x-layout>
    @section('title', __('titles.venue'))
    <x-slot:title>{{__('titles.venue')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Venues') }}</x-slot:heading>
    <x-slot:button>
        <x-form.button href="/venues/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'venue') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="18" align="center" col="">{{__('table.number') }} {{__('table.of') }} {{__('table.locations') }}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.created_at')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.updated_at')}}</x-table.th>
                <x-table.th width="40" align="left" col="">{{__('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($venues as $venue)
            <x-table.tr>
                <x-table.td width="2" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/venues/{{$venue->id}}/edit" icon="pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/venues/{{$venue->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="20" align="left">
                    {{ $venue->name }}
                </x-table.td>
                <x-table.td width="18" align="center">{{ count($venue->locations) }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($venue->created_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($venue->updated_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="30" align="left">{{ \Illuminate\Support\Str::limit($venue->description,20) }}</x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $venues->links() }}</div>
</x-layout>