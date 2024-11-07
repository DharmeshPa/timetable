<x-layout>
    @section('title', __('titles.content'))
    <x-slot:breadcrumb>
        You are here: 
        <a href="/events" class="text-cypher-purple">{{__('titles.event')}}</a> > 
        <a href="/displays/{{request()->route('timetable')->display->event->id}}" class="text-cypher-purple">{{__('titles.display')}}</a> >
        <a href="/timetables/{{request()->route('timetable')->display->id}}" class="text-cypher-purple">{{__('titles.timetable')}}</a> >
        {{__('titles.content')}}
    </x-slot>
    <x-slot:title>{{__('titles.content')}}</x-slot:title>
    <x-slot:heading>{{ sprintf(__('headings.overview'),'Contents') }}</x-slot:heading>
    <x-slot:button>
        <x-form.dropdown timetable-id="{{$timetable->id}}"/>
    </x-slot:button>

    <x-table>
        <thead>
            <x-table.tr>
                <x-table.th width="10" align="center" col=""></x-table.th>
                <x-table.th width="10" align="left" col="">{{ __('table.start_time')}}</x-table.th>
                <x-table.th width="10" align="left" col="">{{ __('table.end_time') }}</x-table.th>
                <x-table.th width="55" align="left" col="">{{__('table.name') }}</x-table.th>
                <x-table.th width="15" align="center" col="">{{__('table.added') }}</x-table.th>
            </x-table.tr>
        </thead>
        <tbody id="sort">
            @foreach ($contents as $key => $content)
            <x-table.tr>
                <x-table.td width="10" align="center" class="bg-cypher-black/10 border-b border-white">
                     <x-table.icons-wrapper>
                        <x-link :sidebar="false" href="/contents/{{$content->id}}/edit" icon="pen" class="text-cypher-black/80"></x-link>
                        <x-link :sidebar="false" href="/contents/{{$content->id}}/duplicate" icon="copy" class="text-cypher-black"></x-link>
                        <x-link :sidebar="false" href="/contents/{{$content->id}}" icon="trash" class="text-cypher-red"></x-link>
                    </x-table.icons-wrapper>
                </x-table.td>
                <x-table.td width="10" align="left" col="">
                    {{  $content->start_time_at }}
                </x-table.td>                                                                                                    
                <x-table.td width="10" align="left" col="">
                    {{ $content->end_time_at }}
                </x-table.td>
                <x-table.td width="55" align="left" col="">
                     <x-link :sidebar="false" href="/contents/{{$content->id}}/edit" icon="" class="text-cypher-purple">
                        @if($content->type == 'topics')
                            @if ($content->group_title)
                                <div>
                                    <span><i class="fa-solid fa-bars"></i></span>
                                    <span>{{ $content->group_title }}</span>
                                </div>
                            @else
                                <div>
                                    <span><i class="fa-solid fa-minus"></i></span>
                                    <span>{{ $content->topics->first()->title }}</span>
                                </div>
                            @endif
                        @endif
                        @if($content->type == 'graphic')
                           <div>
                                <span><i class="fa-solid fa-images"></i></span>
                                <span>Graphics</span>
                            </div>
                        @endif
                        @if($content->type == 'message')
                           <div>
                                <span><i class="fa-solid fa-message"></i></span>
                                <span>Messages</span>
                            </div>
                        @endif
                        @if($content->type == 'video')
                           <div>
                                <span><i class="fa-solid fa-video"></i></span>
                                <span>Videos</span>
                            </div>
                        @endif
                    </x-link>
                </x-table.td>
                <x-table.td width="15" align="center" col="">
                    {{ $content->created_at }}
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table>
    <div class="my-5">{{ $contents->links() }}</div>
</x-layout>