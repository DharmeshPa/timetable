<x-public.content :content=$content :timetable=$timetable {{ $attributes->merge(['class'=>''])}}>
    @foreach ($content->topics as $key => $topic)
    <div class="lg:grid lg:grid-cols-12 gap-0 [.active_&]:border-b-[3px] [.active_&]:border-white border-b-[1px] border-[#d6d6d6] px-[20px] items-center col-span-12">
        <div class="col-span-2 pt-[15px] lg:pb-[15px]">
            <div class="sm:text-[26px] lg:text-[32px]">
                {{ $content->start_time_at }} &ndash; {{ !$content->hide_session_end_time ? $content->end_time_at : '' }}
            </div>
        </div>
        <div class="col-span-7 lg:py-[15px]">
             <div class="text-[32px] {{ $topic->bold ? 'font-bold' : '' }} {{ $topic->italic ? 'italic' : '' }}">{{ $topic->title }}</div>
             <div class="block description">{{ $topic->description }}</div>
        </div>
        <div class="col-span-3 lg:pt-[15px] pb-[15px]">
            <div class="text-[26px]">{{ $topic->location->name }}</div>
        </div>
    </div>
    @endforeach
</x-public.content>