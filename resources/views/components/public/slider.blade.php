@props(['class','content','timetable','wrapper'])
<x-public.content :content=$content :timetable=$timetable {{$attributes->merge(['class'=>'fixed top-0 left-0 right-0 w-100 ' . $wrapper])}}>
    <div class="slides">
        <ul class="bxslider h-100 m-0 p-0 hidden w-100">
            @foreach ($content->graphics as $key => $graphic)
                @if ($graphic->type == $class)
                    <li 
                        class="h-100 w-100" 
                        style="height:100% !important; background:transparent url('{{ config("app.url") ."/". $graphic->path}}') no-repeat center center;background-size: cover;">
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <script type="text/javascript">
        $(function () {
            setTimeout(function(){
                $('.{{$wrapper}} .bxslider').bxSlider({
                    mode: "{{ $timetable->display->event->theme->slider_effect }}",
                    speed:{{ $timetable->display->event->theme->slider_duration }},
                    pause:{{ $timetable->display->event->theme->slider_pause }},
                    easing:"{{ $timetable->display->event->theme->slider_easing }}",
                    auto:true,
                    pager:false,
                    autoStart:true,
                    controls:false,
                    touchEnabled:false,
                    stopAutoOnClick:false,
                    infiniteLoop: true
                });
            }, 1000);
        });
    </script>
</x-public.content>