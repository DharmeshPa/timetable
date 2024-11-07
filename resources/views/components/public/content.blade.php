@props(['timetable','content'])

@php
$timetable_start_date_time = date("Y-m-d",strtotime($timetable->start_at)) . ' '. date("H:i:s",strtotime($timetable->start_time_at));
$timetable_end_date_time = date("Y-m-d",strtotime($timetable->end_at)) . ' '. date("H:i:s",strtotime($timetable->end_time_at));
$content_start_date_time = date("Y-m-d",strtotime($timetable->start_at)) . ' '. date("H:i:s",strtotime($content->start_time_at));
$content_end_date_time = date("Y-m-d",strtotime($timetable->end_at)) . ' '. date("H:i:s",strtotime($content->end_time_at));
$content_expiration_time = Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $content_end_date_time);

if($content->type === 'topics') $content_expiration_time->addMinutes(abs($timetable->item_expire_time));

$classes = 'transition transition-colors duration-200 grid grid-cols-12 gap-0 content-details ' . $content->type;

if($content->type === 'topics') $classes .= ' border-r-[10px]  border-l-[10px] border-white';

@endphp

<div 
    {{ $attributes->merge(['class'=>$classes])}}
    data-timetable-id="{{$timetable->id}}"
    data-timetable-start-time="{{ $timetable_start_date_time }}"
    data-timetable-end-time="{{ $timetable_end_date_time }}"
    data-content-start-time="{{ $content_start_date_time }}"
    data-content-end-time="{{ $content_end_date_time }}"
    data-content-type="{{ $content->type }}"
    data-content-expire-time="{{$content_expiration_time}}">
    {{
    	$slot
    }}
</div>