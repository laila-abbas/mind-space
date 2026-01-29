<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mind Space</title>
    <script src="/js/alpine.min.js" defer></script>
    <style>[x-cloak] { display: none !important; }</style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..600;1,100..600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class='bg-background text-text font-hanken-grotesk pb-20'>
    <div class='px-12'>
        <nav class='flex justify-between items-center py-4 border-b border-black/10'>
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="" class="h-10 w-auto block">
                </a>
            </div>

            <div class='space-x-10 font-bold'>
                <a href="#">Home</a>
                <a href="#">Books</a>
                <a href="#">Authors</a>
                <a href="#">Categories</a>
                <a href="#">Publishing Houses</a>
            </div>

            @auth
                <x-dropdowns.dropdown>
                    <x-slot name="trigger">
                        <img 
                            src="{{ auth()->user()->avatar_url }}" 
                            alt="{{ auth()->user()->first_name }}" 
                            class="w-10 h-10 rounded-full object-cover transition-all duration-300 ease-in-out hover:scale-105 hover:ring-1 hover:ring-accent/25 ring-offset-1 hover:shadow-xl">
                    </x-slot>

                    <x-dropdowns.item href="{{ route('profile.edit') }}">
                        <x-slot name="icon">
                            <img src="{{ asset('images/settings.svg') }}">
                        </x-slot>
                        Settings
                    </x-dropdowns.item>
                    
                    @can('submit book for publishing')
                        <x-dropdowns.item href="/books/create">Add a Book</x-dropdowns.item>
                    @endcan

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="group flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all duration-200 cursor-pointer">
                            <img src="{{ asset('images/logout.svg') }}" class='w-4 h-4'>
                            <span>Log Out</span>
                        </button>
                    </form>
                    
                </x-dropdowns.dropdown>
            @endauth

            @guest
                <div class='space-x-6 font-bold'>
                    <a href={{ route('register') }}>Sign Up</a>
                    <a href={{ route('login') }}>Log In</a>
                </div>
            @endguest
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>