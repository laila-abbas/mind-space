<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      class="{{ app()->getLocale() === 'ar' ? 'font-arabic' : 'font-english' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mind Space</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-bg-page text-text-main font-sans pb-20 transition-colors duration-300">
    <nav x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-bg-page/90">
        
        <div class="px-6 sm-md:px-12 flex justify-between items-center py-4">
            <div>
                <a href="/"> {{-- edit route --}}
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Logo" class="h-10 w-auto">
                </a>
            </div>
            
            <div class="hidden sm-md:flex gap-6 font-bold items-center">
                <x-nav-tabs />
            </div>

            {{-- large screens --}}
            <div class="hidden sm-md:flex items-center">
                <x-user-menu />
            </div>

            {{-- small screens --}}
            <div class="sm-md:hidden">
                <button type="button" @click="mobileOpen = !mobileOpen">
                    <x-lucide-menu x-show="!mobileOpen" x-cloak class="w-6 h-6" />
                    <x-lucide-x x-show="mobileOpen" x-cloak class="w-6 h-6" />
                </button>
            </div>
        </div>

        <div x-show="mobileOpen"
             x-transition.opacity
             x-transition.duration.300ms
             @click.away="mobileOpen = false"
             class="sm-md:hidden fixed inset-x-0 top-[72px] bottom-0 px-6 pb-4 flex flex-col space-y-2 bg-bg-page shadow-md overflow-y-auto z-40"
        >
           <x-user-menu mobile />
        </div>
        
        <div class="sm-md:px-10">
            <div class="h-[1px] w-full bg-border-soft"></div>
        </div>
    </nav>

    <main class="px-6 sm-md:px-12 mt-6">
        {{ $slot }}
    </main>

</body>
</html>
