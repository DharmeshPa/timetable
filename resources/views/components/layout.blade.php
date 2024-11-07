<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-y-scroll"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Roboto font -->
        <link rel="stylesheet" href="{{ asset('css/roboto.css') }}"/>
        <!-- Chosen CSS from CDN -->
        <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}"/>
        <!-- Icons -->
        <script src="{{ asset('js/kit.fontawesome.min.js') }}"></script>
        <!-- Alpine JS - sorting -->
        <script src="{{ asset('js/alpine.sort.min.js') }}"></script>
        <!-- Alpine JS -->
        <script src="{{ asset('js/alpine.min.js') }}" defer></script>
        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- Chosen JS -->
        <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
        <!-- TinyMCE -->
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
        <script>
          tinymce.init({
            license_key: 'gpl',
            selector: 'textarea#editor',
            menubar: false,
            plugins: 'code table lists',
            width: 1200,
            toolbar: 'undo redo | fontfamily | fontsize | forecolor | backcolor | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist '
          });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $("#save select").chosen({
                    inherit_select_classes:true,
                    width:'100%'
                });
            });
        </script>
        <!-- Styles -->
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-white">
        <x-header>
            
            <div class="bg-cypher-gray flex-0 w-[89px] py-3 px-5">
                <x-logo 
                    logo="{{asset('images/POD-With-Text-Icon.svg')}}" 
                    type="image" 
                    class="w-[49px] m-auto"/>
            </div>

            <x-header.icon icon="house"/>
            <x-header.title title="{{ $title }}"/>

            @if(!request()->is('login'))
            <div class="flex">
                <x-link  
                href="/events" 
                icon="house" 
                class="text-white items-center {{ request()->is('events') || request()->is('events/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.event') }}
                </x-link>

                <x-link  
                href="/venues" 
                icon="building" 
                class="text-white items-center {{ request()->is('venues') || request()->is('venues/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.venue') }}
                </x-link>

                <x-link  
                href="/locations" 
                icon="person-booth" 
                class="text-white items-center {{ request()->is('locations') || request()->is('locations/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.location') }}
                </x-link>

                <x-link  
                href="/crews" 
                icon="users-gear" 
                class="text-white items-center {{ request()->is('crews') || request()->is('crews/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.crew') }}
                </x-link>

                <x-link  
                href="/roles" 
                icon="user-tie" 
                class="text-white items-center {{ request()->is('roles') || request()->is('roles/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.role') }}
                </x-link>

                <x-link  
                href="/users" 
                icon="users" 
                class="text-white items-center {{ request()->is('users') || request()->is('users/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.users') }}
                </x-link>

                <x-link  
                href="/themes" 
                icon="palette" 
                class="text-white items-center {{ request()->is('themes') || request()->is('themes/*') ? 'bg-cypher-purple-50' : ''}}">{{ __('anchors.theme') }}
                </x-link>

                @auth
                <div x-data="{ open: false }" class="relative flex">
                    <x-header.dropdown />
                </div>   
                @endauth             
            </div>
            @endif
        </x-header>
        <main class="flex flex-col p-3">

            <!-- Breadcrumb -->
            @if(isset($breadcrumb))
            <div>{{ $breadcrumb }}</div>
            @endif

            <!-- Page heading -->
            <div class="flex justify-between items-center mb-3 mt-3">
                @if (isset($heading))
                    <x-heading heading="{{$heading}}" {{ $attributes->merge()}}/>
                @endif

                @if(isset($button))
                    {{$button}}
                @endif
            </div>

            @if ($errors->any())
                <div class="p-5 bg-cypher-red rounded mb-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                @if (session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif

                @if (session('error'))
                    <x-alert type="error">{{ session('error') }}</x-alert>
                @endif

                {{$slot}}
            </div>
        </main>
    </body>
</html>