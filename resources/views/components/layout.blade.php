<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mind Space</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..600;1,100..600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-page text-text-main font-hanken-grotesk pb-20 transition-colors duration-300">
    <div class='px-12'>
        <nav class='flex justify-between items-center py-4 border-b border-border-soft'>
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
                        <x-lucide-user-round
                            class="w-10 h-10 p-2 rounded-full
                                bg-bg-muted text-text-muted
                                dark:bg-bg-surface dark:text-text-main dark:hover:ring-brand-accent-2
                                transition-all duration-300
                                hover:scale-105 hover:ring-1 hover:ring-brand-accent-2/25"
                        />
                    </x-slot>

                    <x-dropdowns.item href="{{ route('profile.edit') }}">
                        <x-slot name="icon">
                            <x-lucide-settings />
                        </x-slot>
                        Settings
                    </x-dropdowns.item>
                    
                    @can('submit book for publishing')
                        <x-dropdowns.item href="/books/create">Add a Book</x-dropdowns.item>
                    @endcan

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="group flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm font-medium text-text-muted hover:bg-red-50 hover:text-red-500 rounded-lg transition-all duration-200 cursor-pointer">
                            <x-lucide-log-out class='w-4 h-4' />
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