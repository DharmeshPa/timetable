<x-public.content :content=$content :timetable=$timetable {{ $attributes->merge(['class'=>''])}}>
    <div class="lg:grid lg:grid-cols-12 gap-0 border-b-[1px] [.active_&]:border-white/10 border-[#d6d6d6] px-[20px] col-span-12">
        <div class="col-span-2 pt-[15px] lg:pb-[15px] border-b-[1px] border-white/10">
            <div class="sm:text-[26px] lg:text-[32px]">
                {{ $content->start_time_at }} &ndash; {{ !$content->hide_session_end_time ? $content->end_time_at : '' }}
            </div>
        </div>
        <div class="col-span-7 lg:py-[15px] border-b-[1px] border-white/10">
            <div class="text-[32px] {{ $content->group_title_bold ? 'font-bold' : '' }} {{ $content->group_title_italic ? 'italic' : '' }}">
                {{ $content->group_title }}
            </div>
        </div>
        <div class="hidden lg:block col-span-3 py-[15px] border-b-[1px] border-white/10">
            <div class="text-[26px]">&nbsp;</div>
        </div>
    </div>
    @foreach ($content->topics as $key => $topic)
    <div class="lg:grid lg:grid-cols-12 gap-0 [.active_&]:last:border-white [.active_&]:border-white/10 [.active_&]:last:border-b-[3px] border-b-[1px] border-[#d6d6d6] px-[20px] items-center col-span-12">
        <div class="hidden lg:block col-span-2 pt-[5px] pb-[10px]">
            <div class="sub-title">&nbsp;</div>
        </div>
        <div class="col-span-7 lg:pt-[5px] lg:pb-[10px]">
            <div class="text-[26px] sub-title {{ $content->group_title_bold ? 'font-bold' : '' }} {{ $content->group_title_italic ? 'italic' : '' }}">
                {{ $topic->title }}
            </div>
            <div class="block description">{{ $topic->description }}</div>
        </div>
        <div class="col-span-3 pt-[5px] pb-[10px]">
            <div class="text-[26px]">{{ $topic->location->name }}</div>
        </div>
    </div>
    @endforeach
</x-public.content>
