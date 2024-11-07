<x-layout>
    @section('title', __('titles.theme'))

    <x-slot:breadcrumb>
        You are here: <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a>
    </x-slot>

    <x-slot:title>
        {{__('titles.theme')}}
    </x-slot:title>
    

    <x-slot:heading>{{ sprintf(__('headings.overview'),'Themes') }}</x-slot:heading>
    
    <x-slot:button>
        <x-form.button href="/themes/create" icon="plus" :outline="true">
            {{ sprintf(__('forms.btn_new'),'theme') }}
        </x-form.button>
    </x-slot:button>

    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="20" align="left" col="">{{ __('table.name')}}</x-table.th>
                <x-table.th width="70" align="left" col="">{{ __('table.event')}}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
        @foreach ($themes as $theme)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                    <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/themes/{{$theme->id}}/edit" icon="pen" class="text-cypher-purple/80"></x-link>
                        <x-link :sidebar="false" href="/themes/{{$theme->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>

                <x-table.td width="20" align="left">
                    {{ $theme->name }}
                </x-table.td>

                <x-table.td width="70" align="left">
                    <?php foreach ($theme->events as $key => $event): ?>
                        <x-link :sidebar="false" href="/events/{{$event->id}}/edit" icon="" class="text-cypher-purple">
                            {{ $event->name }}
                        </x-link>
                    <?php endforeach ?>
                </x-table.td>
            </x-table.tr>
        @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $themes->links() }}</div>
</x-layout>