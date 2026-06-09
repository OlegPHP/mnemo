<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mnemo</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

<!-- Верхний бар -->
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

<!-- Основной контент -->
<main class="flex flex-1 flex-col md:flex-row items-center justify-center p-8 md:p-16 space-y-8 md:space-y-0 md:space-x-16">
    <div class="flex-shrink-0">
        <img src="{{ asset('image/mnemo.jpg') }}" alt="Mnemo Logo" class="w-48 h-auto mx-auto md:mx-0">
    </div>
    <div class="text-center md:text-left max-w-lg space-y-4">
        <p class="text-2xl font-bold text-gray-900">
            Мнемотехники. Теория и практика.
        </p>
        <p class="text-lg text-gray-700">
            Мы хотим помочь вам улучшить память с помощью простых и эффективных методик.
        </p>

            <a href="{{ route('description') }}"
               class="inline-block mt-4 px-5 py-2 bg-gradient-to-r from-yellow-100 to-yellow-200
                      rounded-xl shadow-md hover:shadow-lg transition-all duration-200
                      text-gray-900 font-semibold hover:from-yellow-200 hover:to-yellow-300">
                Узнать больше о проекте
            </a>

    </div>
</main>

<footer class="mt-auto p-4 border-t border-gray-200 text-center text-sm">
    Oleg Vlasov's projects {{date('Y')}}. All rights reserved.
</footer>
</body>
</html>
