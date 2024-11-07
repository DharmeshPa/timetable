<x-public.content :content=$content :timetable=$timetable {{ $attributes->merge(['class'=>'flex items-center justify-center'])}} style="height:100%;z-index:99">
    <ul class="grid grid-cols-12 gap-0 p-0 m-0 col-span-12 hidden items-center" style="height:100%">
        <li class="col-span-12 py-0 m-0 p-0 text-center">
             @foreach ($content->messages as $key => $message)
                {!! $message->message !!}
             @endforeach
        </li>
    </ul>
</x-public.content>