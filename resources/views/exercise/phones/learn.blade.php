<x-layouts.app :title="'Мнемотехники — список номеров'">
    <div class="flex flex-col items-center justify-start min-h-[70vh] px-4 pt-12 pb-12">
        <div class="w-full max-w-3xl bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-800 rounded-2xl p-8 shadow-md transition-colors space-y-4">
            <h1 class="text-2xl font-semibold text-center text-neutral-900 dark:text-white mb-6">
                Учим список номеров
            </h1>

            @foreach($selectedItems as $item)
                <div class="flex justify-center bg-neutral-50 dark:bg-neutral-800 rounded-lg p-4 shadow-sm transition-colors">
                    <span class="font-medium text-neutral-900 dark:text-white text-lg">
                        {{$loop->iteration}}. 📱  {{ $item }}
                    </span>
                </div>
            @endforeach
            <flux:button
                href="{{ route('exercises.phones.test', ['exercise' => $exercise->slug]) }}"
                type="submit"
                variant="primary"
                color="yellow"
                class="w-full mt-4 cursor-pointer">
                Начать тест
            </flux:button>
        </div>
    </div>
</x-layouts.app>
