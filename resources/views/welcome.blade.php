<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">

        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div id="welcomeBladeLine22" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div id="welcomeBladeLine23" class="flex justify-between h-16">
                    <div id="welcomeBladeLine24" class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/">
                                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                            </a>
                        </div>

                        <x-nav-link id="welcomeBladeLine32" href="/publicAboutUrl">
                            {{ __('About Public - MF') }}
                        </x-nav-link>

                        <x-nav-link id="welcomeBladeLine36" href="/publicProjectUrl">
                            {{ __('Project Public - MF') }}
                        </x-nav-link>


                    </div>       

                </div>
            </div>
            
        </nav>

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <x-nav-link id="navigationBladeLine15" :href="route('notes.index')" :active="request()->routeIs('notes.index')">
                        {{ __('Notes') }}
                    </x-nav-link>

                    <x-nav-link id="navigationBladeLine15" :href="route('abouts.index')" :active="request()->routeIs('abouts.index')">
                        {{ __('Abouts') }}
                    </x-nav-link>

                    <x-nav-link id="navigationBladeLine15" :href="route('projects.index')" :active="request()->routeIs('projects.index')">
                        {{ __('Projects') }}
                    </x-nav-link>
                    @else
                        <a id="welcomeBladeLine45" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a id="welcomeBladeLine28"  href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
                        <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
     
                            @forelse ($aboutMe as $project)
                            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                                
                                <h2 class="text-2xl mt-2">
                                    <a>{{ $project->text }}</a>
                                </h2>          
                               
                            </div>
                        @empty
                        <p>You have no projects yet.</p>
                        @endforelse
     
                        </div>
                    
                </div>
            </div>

           
           
        </div>



    </body>
</html>
