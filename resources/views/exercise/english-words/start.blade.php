<x-layouts.app :title="'Мнемотехники — список английских слов'">
    <div class="flex flex-col items-center justify-center min-h-[70vh] px-4">
        <div class="w-full max-w-md bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-800 rounded-2xl p-8 shadow-md transition-colors">
            <h1 class="text-2xl font-semibold text-center text-neutral-900 dark:text-white mb-6">
                Выберите количество слов
            </h1>
            @if(session('message'))
                <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded-xl">
                    {{ session('message') }}
                </div>
            @endif


            <form action="{{ route('exercises.words.learn', ['exercise' => $exercise->slug]) }}" method="GET" class="space-y-6">
                <flux:select name="number" placeholder="Количество слов" class="w-full cursor-pointer">
                    @for ($i = 1; $i <= 25; $i++)
                        <flux:select.option>{{ $i }}</flux:select.option>
                    @endfor
                </flux:select>
                <flux:error name="number" />
                <flux:button
                    type="submit"
                    variant="primary"
                    color="yellow"
                    class="w-full mt-4 cursor-pointer">
                    Начать упражнение
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts.app>
