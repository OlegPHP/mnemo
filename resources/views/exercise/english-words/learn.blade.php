<x-layouts.app :title="'Мнемотехники — список английских слов'">
    <div class="flex flex-col items-center justify-start min-h-[70vh] px-4 pt-12 pb-12">
        <div class="w-full max-w-3xl bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-800 rounded-2xl p-8 shadow-md transition-colors space-y-4">
            <h1 class="text-2xl font-semibold text-center text-neutral-900 dark:text-white mb-6">
                Учим английские слова
            </h1>

            @foreach($selectedWords as $word)
                <div class="flex justify-center bg-neutral-50 dark:bg-neutral-800 rounded-lg p-4 shadow-sm transition-colors">
                    <span class="font-medium text-neutral-900 dark:text-white text-lg">
                        {{ $word['word'] }} — {{ $word['translation'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
