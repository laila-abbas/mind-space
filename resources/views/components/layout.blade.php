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
<body class='bg-background text-text font-hanken-grotesk pb-20'>
    <div class='px-12'>
        <nav class='flex justify-between items-center py-4 border-b border-black/10'>
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="" class="h-12 w-auto block">
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
                <div class='space-x-6 font-bold flex'>
                    @can('submit book for publishing')
                        <a href="/books/create">Add a Book</a> 
                    @endcan
                    <form method='POST' action='/logout'>
                        @csrf
                        @method('DELETE')
                        <button>Log Out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class='space-x-6 font-bold'>
                    <a href="/register">Sign Up</a>
                    <a href="/login">Log In</a>
                </div>
            @endguest
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>