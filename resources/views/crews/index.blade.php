<x-layout>
    @section('title', __('titles.crew'))
    <x-slot:title>{{__('titles.crew')}}</x-slot:title>

    <x-slot:heading>{{ sprintf(__('headings.overview'),'Crews') }}</x-slot:heading>

    <x-slot:button>
        <x-form.button href="/crews/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'crew') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.email') }}, {{__('table.phone')}}</x-table.th>
                <x-table.th width="10" align="left" col="">{{__('table.roles') }}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.created_at')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.updated_at')}}</x-table.th>
                <x-table.th width="20" align="left" col="">{{__('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($crews as $crew)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/crews/{{$crew->id}}/edit" icon="pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/crews/{{$crew->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>

                <x-table.td width="20" align="left">
                    {{ $crew->name }}
                </x-table.td>
                <x-table.td width="20" align="left">
                    <x-link :sidebar="false" href="/crews/{{$crew->id}}/edit" icon="" class="text-cypher-purple">
                        <div class="flex flex-col">
                            <span>{{ $crew->email }}</span>
                            <span>{{ $crew->phone }}</span>
                        </div>
                    </x-link>
                </x-table.td>
                <x-table.td width="10" align="left">
                    @if($crew->roles)
                        @foreach ($crew->roles as $role)
                        <ul class="m-0 p-0">
                            <li>
                                <x-link :sidebar="false" href="/roles/{{$role->id}}/edit" icon="" class="text-cypher-purple">
                                    - {{ $role->title }}
                                </x-link>
                            </li>
                        </ul>
                        @endforeach
                    @endif
                </x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($crew->created_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($crew->updated_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="20" align="left">{{ \Illuminate\Support\Str::limit($crew->description,20) }}</x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $crews->links() }}</div>
</x-layout>