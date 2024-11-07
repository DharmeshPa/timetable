<div class="grid grid-cols-12 gap-0 header relative z-[99] border-t-[10px] border-r-[10px]  border-l-[10px] border-white">
    <div class="col-span-6 text-left font-bold">
        {{ $timetable->name}}
    </div>
    <div class="col-span-6 text-right font-bold">
        {{ Illuminate\Support\Carbon::now()->addHours($timetable->display->event->offset)->format('H:i') }}
    </div>
</div>
<div class="grid grid-cols-12 gap-0 sub-header relative z-[99] bg-white border-r-[10px]  border-l-[10px] border-white">
    <div class="col-span-12 text-left font-bold">
        {{ $timetable->display->name}}
    </div>
</div>