<x-layout>
    @section('title', __('titles.role'))
    <x-slot:title>{{__('titles.role')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Roles') }}</x-slot:heading>
    <x-slot:button>
        <x-form.button href="/roles/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'role') }}
        </x-form.button>
    </x-slot:button>
    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="20" align="center" col="">{{__('table.crews') }}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.created_at')}}</x-table.th>
                <x-table.th width="10" align="center" col="">{{ __('table.updated_at')}}</x-table.th>
                <x-table.th width="30" align="left" col="">{{__('table.desc')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($roles as $role)
            <x-table.tr>

                 <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                     <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/roles/{{$role->id}}/edit" icon="pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/roles/{{$role->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>

                <x-table.td width="20" align="left">
                    {{ $role->title }}
                </x-table.td>
                
                <x-table.td width="20" align="center">
                    {{ count($role->crews) }}
                </x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($role->created_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="10" align="center">{{ \Carbon\Carbon::parse($role->updated_at)->format('d-m-Y') }}</x-table.td>
                <x-table.td width="30" align="left">{{ \Illuminate\Support\Str::limit($role->description,20) }}</x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $roles->links() }}</div>
</x-layout>