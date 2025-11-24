<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $theory->title }} — Mnemo</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

<header class="flex justify-between items-center p-4 border-b border-gray-200">
    <div class="text-2xl font-bold">Mnemo</div>
    <div class="space-x-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="px-3 py-1 rounded">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-3 py-1 rounded">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-3 py-1 rounded">Register</a>
                @endif
            @endauth
        @endif
    </div>
</header>

<main class="flex flex-col items-center p-8 md:p-16 space-y-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 text-center">
        {{ $theory->title }}
    </h1>

    <div class="article-content max-w-3xl bg-yellow-50 dark:bg-yellow-900 p-6 rounded-xl shadow-md space-y-6 text-lg text-gray-800 dark:text-gray-200">
        {!! $theory->content !!}
    </div>

    <a href="{{ route('description') }}"
       class="mt-4 px-5 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
        Назад к теории
    </a>
</main>

<footer class="mt-auto p-4 border-t border-gray-200 text-center text-sm">
    Oleg Vlasov's projects 2025. All rights reserved.
</footer>
</body>
</html>
