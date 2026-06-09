<x-layouts.app title="Мнемотехники — Смена пароля">

    <x-settings.layout
        heading="Пароль"
        subheading="Изменение пароля учетной записи">

        @if(session('status'))
            <div class="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-300">
                ✓ Пароль успешно изменён
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('password.update') }}"
            class="max-w-xl space-y-6"
        >
            @csrf
            @method('PUT')

            <div>
                <label
                    for="current_password"
                    class="mb-2 block text-sm font-medium text-zinc-200"
                >
                    Текущий пароль
                </label>

                <input
                    id="current_password"
                    type="password"
                    name="current_password"
                    class="w-full rounded-lg border border-zinc-600 bg-zinc-800 px-3 py-2 text-white focus:border-blue-500 focus:outline-none"
                >

                @error('current_password')
                    <p class="mt-1 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="password"
                    class="mb-2 block text-sm font-medium text-zinc-200"
                >
                    Новый пароль
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="w-full rounded-lg border border-zinc-600 bg-zinc-800 px-3 py-2 text-white focus:border-blue-500 focus:outline-none"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="password_confirmation"
                    class="mb-2 block text-sm font-medium text-zinc-200"
                >
                    Подтверждение нового пароля
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="w-full rounded-lg border border-zinc-600 bg-zinc-800 px-3 py-2 text-white focus:border-blue-500 focus:outline-none"
                >
            </div>

            <button
                type="submit"
                class="cursor-pointer rounded-lg border border-zinc-500 bg-blue-600 px-4 py-2 font-medium text-white transition hover:bg-blue-700 hover:border-zinc-400"
            >
                Сохранить пароль
            </button>

        </form>

    </x-settings.layout>

</x-layouts.app>