<x-layout>
    @section('title', __('titles.user'))
    <x-slot:title>{{__('titles.user')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Users') }}</x-slot:heading>
    <x-slot:button>
        <x-form.button href="/users/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'user') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="35" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="35" align="left" col="">{{__('table.email') }}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.created_at')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.updated_at')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($users as $user)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/users/{{$user->id}}/edit" icon="pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/users/{{$user->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="35" align="left">
                    {{ $user->name }}
                </x-table.td>
                <x-table.td width="35" align="left">{{ $user->email }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($user->updated_at)->format('d-m-Y') }}</x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $users->links() }}</div>
</x-layout>