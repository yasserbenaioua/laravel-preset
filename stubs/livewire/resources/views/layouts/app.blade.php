<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
            
            <x-sidebar/>
            
            <div class="flex flex-col w-0 flex-1 overflow-hidden">

                @livewire('header')
                
                <main class="flex-1 relative overflow-y-auto focus:outline-none" tabindex="0" x-data="">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $header }}</h1>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 md:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
