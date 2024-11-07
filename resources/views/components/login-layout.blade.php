<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('titles.login') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <script src="https://kit.fontawesome.com/f7d1e3ebcb.js" crossorigin="anonymous"></script>
        
        <!-- Styles -->
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-cypher-purple h-[100vh] flex items-center justify-center flex-col">

        <div class="bg-white p-10 rounded shadow shadow-cypher-purple">
            
             @if ($errors->any())
                <div class="p-5 bg-cypher-red rounded mb-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </div>
    </body>
</html>
