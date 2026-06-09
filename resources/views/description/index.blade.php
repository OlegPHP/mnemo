<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mnemo — Теория</title>
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

<main class="flex flex-col items-center p-8 md:p-16 space-y-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 text-center">
        Теория мнемотехник
    </h1>
    <p class="text-lg text-gray-700 dark:text-gray-300 text-center max-w-2xl">
        Каждая статья — шаг к тому, чтобы ваша память стала инструментом, а не проблемой. Для практики потребуется регистрация.
    </p>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
        @foreach($theories as $theory)
            <a href="{{ route('description.show', ['theory' => $theory->slug]) }}"
               class="block p-6 bg-gradient-to-r from-yellow-100 to-yellow-200
                      rounded-xl shadow-md hover:shadow-lg transition-all duration-200
                      text-gray-900 font-semibold hover:from-yellow-200 hover:to-yellow-300">
                {{ $theory->title }}
            </a>
        @endforeach
    </div>

    <div class="mt-8 flex space-x-4">
        <a href="{{ route('login') }}"
           class="px-5 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
            Авторизуйтесь
        </a>
        <a href="{{ route('register') }}"
           class="px-5 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
            Зарегистрируйтесь
        </a>
    </div>
</main>

<footer class="mt-auto p-4 border-t border-gray-200 text-center text-sm">
    Oleg Vlasov's projects {{date('Y')}}. All rights reserved.
</footer>
</body>
</html>
