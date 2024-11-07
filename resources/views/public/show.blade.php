<x-public-layout :$display>
@if (!empty($timetable))
    <x-public.header :$timetable />
    <!-- Do we have the contents? -->
    @if ($contents->isNotEmpty())
        <div class="grid grid-cols-12 gap-0">
            <div class="col-span-12">
                <x-public.headings />
                <div class="relative">
                    <div class="scroll overflow-hidden absolute top-0 right-0 left-0">
                        @foreach ($contents as $key => $content)
                            @if ($content->type === 'topics')
                                @if ($content->group_title)
                                    <x-public.multiple :content=$content :timetable=$timetable />
                                @else
                                    <x-public.single :content=$content :timetable=$timetable />
                                @endif
                            @endif
                            @if ($content->type === 'graphic')
                                <!-- Graphics - desktop -->
                                <x-public.slider class="landscape" wrapper="landscape-contents" :content=$content :timetable=$timetable />
                                <!-- Graphics - portrait-->
                                <x-public.slider class="portrait" wrapper="portrait-contents" :content=$content :timetable=$timetable />
                            @endif

                            @if ($content->type === 'message')
                                <!-- Messages -->
                                <x-public.message :content=$content :timetable=$timetable />
                            @endif
                        @endforeach
                    </div>
                    <div id="no-content" class="py-[10px] px-[20px] font-bold bg-white border-r-[10px]  border-l-[10px] border-white"></div>
                </div>
            </div>
        </div>
    @else
        <div id="no-content" class="py-[10px] px-[20px] font-bold bg-white border-r-[10px]  border-l-[10px] border-white">{{ __('messages.no_contents') }}</div>
    @endif
@else
    <div class="grid grid-cols-12 gap-0">
        <div class="col-span-12 text-left font-bold">
            <div id="no-timetable" class="py-[10px] px-[20px] font-bold bg-white border-r-[10px]  border-l-[10px] border-white">{{__('messages.no_timetable')}}
            </div>
        </div>
    </div>
@endif
</x-public-layout>