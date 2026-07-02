<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mnemo — Политика конфиденциальности</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

<!-- Верхний бар -->
<header class="flex justify-between items-center p-4 border-b border-gray-200">
    <div class="text-2xl font-bold"><a href="{{route('home')}}">MnemoLab</a></div>
    <div class="space-x-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="px-3 py-1 rounded">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-3 py-1 rounded">Вход</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-3 py-1 rounded">Регистрация</a>
                @endif
            @endauth
        @endif
    </div>
</header>

<main class="flex flex-col items-center p-8 md:p-16 space-y-8">
    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 text-center">
        Политика конфиденциальности
    </h2>
    <div class="py-8 max-w-4xl mx-auto px-4">
        <div class="bg-white p-6 rounded shadow space-y-4 text-gray-700">

            <p>
                Этот сайт не продаёт данные.
                Собираются только те данные, которые нужны для работы аккаунта.
            </p>

            <p>
                Мы храним: email, имя пользователя и пароль в зашифрованном виде.
            </p>

            <p>
                Данные используются исключительно для авторизации и работы сервиса.
            </p>

            <p>
                Cookie используются только для поддержания сессии входа.
            </p>

            <p>
                Пользователь может удалить аккаунт в любой момент.
            </p>

            <p>
                По вопросам работы сайта и обработки персональных данных просьба обращаться по

                Email: <b>myl0@bk.ru</b>
            </p>

            <hr>

            <p class="text-sm text-gray-500">
                Последнее обновление: {{ date('Y-m-d') }}
            </p>

        </div>
    </div>


</main>

<footer class="mt-auto p-4 border-t border-gray-200 text-center text-sm">
    Oleg Vlasov's projects {{date('Y')}}. All rights reserved.
</footer>
</body>
</html>
