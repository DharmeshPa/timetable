<!DOCTYPE html class="h-100 relative">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$display->event->name}}</title>
        
        <!-- Roboto font -->
        <link rel="stylesheet" href="{{ asset('css/roboto.css') }}"/>

        <!-- bxSlider -->
        <link rel="stylesheet" href="{{ asset('css/bxSlider/jquery.bxslider.min.css') }}"/>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!-- bxSlider -->
        <script src="{{ asset('js/bxSlider/jquery.bxslider.min.js') }}"></script>

        <!-- Moment JS - for date and time -->
        <script src="{{ asset('js/moment.js') }}"></script>

        <!-- Site JS -->
        <script src="{{ asset('js/site.js') }}"></script>

        <!-- Scrolling -->
        <script src="{{ asset('js/scroll.js') }}"></script>

        <!-- System time -->
        <script type="text/javascript">
            var systemTime = "{{ Illuminate\Support\Carbon::now()->addHours($display->event->offset) }}";
            var offset = {{$display->event->offset}};
        </script>
        
        <!-- Styles -->
        @vite(['resources/css/app.css','resources/js/app.js'])

        <!-- Dymanic CSS -->
        <style type="text/css">
            
            {{ $display->event->theme->custom_css }}

            body{ 
                background: url("{{config('app.url') .'/'. $display->event->theme->bg_image}}")
            }
        </style>
    </head>
    <body class="relative h-100 bg-cover bg-no-repeat bg-center">
        {{ $slot }}
    </body>
</html>