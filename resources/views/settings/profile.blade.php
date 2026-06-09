<x-layouts.app title="Мнемотехники — Профиль">

    <x-settings.layout
        heading="Профиль"
        subheading="Изменение имени и email">

        @if(session('status'))
            <div class="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-300">
                ✓ Данные успешно сохранены
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('profile.update') }}"
            class="max-w-xl space-y-6"
        >
            @csrf
            @method('PUT')

            <div>
                <label
                    for="name"
                    class="mb-2 block text-sm font-medium text-zinc-200"
                >
                    Имя
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded-lg border border-zinc-600 bg-zinc-800 px-3 py-2 text-white focus:border-blue-500 focus:outline-none"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="email"
                    class="mb-2 block text-sm font-medium text-zinc-200"
                >
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full rounded-lg border border-zinc-600 bg-zinc-800 px-3 py-2 text-white focus:border-blue-500 focus:outline-none"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="cursor-pointer rounded-lg border border-zinc-500 bg-blue-600 px-4 py-2 font-medium text-white transition hover:bg-blue-700 hover:border-zinc-400"            >
                Сохранить
            </button>

        </form>

    </x-settings.layout>

</x-layouts.app>